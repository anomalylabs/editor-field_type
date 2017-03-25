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

            init: function () {

                var self = this;

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

                    // Red button event listener
                    $(file.previewElement).on('click', '.dz-error-mark', function () {
                        forceDelete(id, file);
                    });

                    // Green button event listener
                    $(file.previewElement).on('click', '.dz-success-mark', function () {
                        pasteToEditor(file);
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
            }
        });

    });
});
