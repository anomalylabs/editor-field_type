$(document).on('ajaxComplete ready', function () {

    // Initialize editors.
    $('textarea[data-provides="anomaly.field_type.editor"]').each(function () {

        var lang = $(this).data('mode');
        var theme = $(this).data('theme');
        var wrapper = $(this).closest('.editor-field_type ');

        var editor = $(this).ace({
            lang: lang,
            theme: theme,
            width: $(this).closest('editor')
        });

        if ($(this).data('word-wrap') == 'yes') {
            editor.data('ace').editor.ace.getSession().setUseWrapMode(true);
        }

        // Toggle fullscreen mode.
        wrapper.find('[data-toggle="fullscreen"]').on('click', function (e) {

            e.preventDefault();

            var group = $(this).closest('.editor-field_type');
            var icon = $(this).find('i');

            // Fullscreen the field group.
            group.toggleClass('fullscreen');

            // Resize or restore.
            if (group.hasClass('fullscreen')) {

                group.find('.ace_editor, .ace_content').css('height', $(window).height()).find('textarea').focus();
                icon.toggleClass('fa-expand').toggleClass('fa-compress');
                window.dispatchEvent(new Event('resize'));
            } else {

                group.find('.ace_editor, .ace_content').css('height', group.find('textarea').first().height());
                icon.toggleClass('fa-expand').toggleClass('fa-compress');
                window.dispatchEvent(new Event('resize'));
            }
        });

        /**
         * Deleting and force deleting of a file
         *
         * @param      {Number}    id        The identifier
         * @param      {Boolean}   force     The force
         * @param      {Function}  callback  The callback
         */
        var deleteFile = function(id, force, callback) {
            var xhr = new XMLHttpRequest();
            var formData = new FormData();
            var url = force ? '/admin/files?view=trash' : '/admin/files';
            var action = force ? 'force_delete' : 'delete';

            formData.append('action', action);
            formData.append('id[]', id);

            xhr.open('POST', url, true);
            xhr.setRequestHeader('X-CSRF-Token', CSRF_TOKEN);
            xhr.onreadystatechange = callback;

            xhr.send(formData);
        };

        /**
         * Gets the image html tag.
         *
         * @param      {string}  src     The source
         * @return     {string}  The image html tag.
         */
        var getImgHtmlTag = function (src) {
            return '<img src="{{ image(\'' + src + '\') }}" />';
        };

        /**
         * Paste tag to the editor
         *
         * @param      {Object}  file    The file
         */
        var pasteToEditor = function (file) {
            editor.data('ace').editor.ace.insert(getImgHtmlTag(file.name));
        };

        $('.ace_content').dropzone({
            url: '/admin/files/upload/handle',
            paramName: 'upload',
            previewsContainer: '.droppedFilesContainer',
            clickable: false,
            createImageThumbnails: true,
            // thumbnailWidth: 400,
            // thumbnailHeight: 200,
            previewTemplate: document.getElementById('preview-template').innerHTML,

            init: function () {

                var self = this;
                var filters = [];

                /**
                 * Force deleting query
                 *
                 * @param      {Number}  id      The identifier
                 * @param      {Object}  file    The file
                 */
                var forceDelete = function (id, file) {
                    deleteFile(id, false, function () {
                        if (this.readyState != 4 || this.status != 200) {
                            return;
                        }
                        deleteFile(id, true, function () {
                            if (this.readyState != 4 || this.status != 200) {
                                return;
                            }
                            self.removeFile(file);
                        })
                    })
                };

                // Before send
                this.on('sending', function (file, xhr, formData) {
                    xhr.setRequestHeader('X-CSRF-Token', CSRF_TOKEN);
                    formData.append('folder', '1');
                });

                // After success send
                this.on('success', function (file, response) {
                    var id = response.id;
                    var additionClass = response.mime_type && response.mime_type.replace('/', '-') || 'default';

                    if (!filters.includes(additionClass)) {
                        filters.push(additionClass);
                    }

                    file.previewElement.classList.add(additionClass);

                    // Red button event listener
                    $(file.previewElement).on('click', '.dz-error-mark', function () {
                        forceDelete(id, file);
                    });

                    // Green button event listener
                    $(file.previewElement).on('click', '.dz-success-mark', function () {
                        pasteToEditor(file);
                    });
                });

                this.on('queuecomplete', function () {
                    var $filters = $('.droppedFilesFilters');
                    var $grid = $('.droppedFilesContainer').isotope({
                        itemSelector: '.dz-preview',
                        layoutMode: 'fitRows',
                    });
                    var docElemStyle = document.documentElement.style;
                    var transitionProp = typeof docElemStyle.transition == 'string' ?
                        'transition' :
                        'WebkitTransition';
                    var transitionEndEvent = {
                        WebkitTransition: 'webkitTransitionEnd',
                        transition: 'transitionend',
                    }[transitionProp];

                    var setItemContentPixelSize = function (itemContent) {
                        var previousContentSize = getSize( itemContent );
                        itemContent.style[transitionProp] = 'none';
                        itemContent.style.width = previousContentSize.width + 'px';
                        itemContent.style.height = previousContentSize.height + 'px';
                    };

                    var addTransitionListener = function (itemContent) {
                        if (!transitionProp) {
                            return;
                        }
                        var onTransitionEnd = function () {
                            itemContent.style.width = '';
                            itemContent.style.height = '';
                            itemContent.removeEventListener( transitionEndEvent, onTransitionEnd );
                        };
                        itemContent.addEventListener( transitionEndEvent, onTransitionEnd );
                    };

                    var setItemContentTransitionSize = function (itemContent, itemElem) {
                        var size = getSize(itemElem);
                        itemContent.style.width = size.width + 'px';
                        itemContent.style.height = size.height + 'px';
                    };

                    filters.push('all');

                    filters.forEach(function (filter) {
                        var $button = $('<button/>', { id: 'f-' + filter }).html(filter);
                        var $wrapper = $('<span/>', { 'class': filter }).append($button);

                        $button.on('click', function (e) {
                            e.preventDefault();

                            var name = this.id.replace('f-', '');

                            $grid.isotope({
                                filter: function () {
                                    if (name === 'all') {
                                        return true;
                                    }
                                    return this.classList.contains(name);
                                },
                            })
                        });

                        $filters.append($wrapper);
                    });

                    $grid.on('click', '.inner', function () {
                        var itemContent = this;
                        setItemContentPixelSize(itemContent);

                        var itemElem = itemContent.parentNode;
                        $(itemElem).toggleClass('is-expanded');

                        var redraw = itemContent.offsetWidth;
                        itemContent.style[transitionProp] = '';

                        addTransitionListener(itemContent);
                        setItemContentTransitionSize(itemContent, itemElem);

                        $grid.isotope('layout');
                    });
                });
            },

            /**
             * Validation of file
             *
             * @param      {Object}    file    The file
             * @param      {Function}  done    The done
             * @TODO Need to remove Bieber!
             */
            accept: function (file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },
        });

    });
});
