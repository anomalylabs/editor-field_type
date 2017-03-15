$(document).on('ajaxComplete ready', function () {
    // Initialize editors.
    $('textarea[data-provides="anomaly.field_type.editor"]')
        .each(function () {
            var $this = $(this);
            var $wrapper = $this.closest('.editor-field_type ');
            var wordWrap = $this.data('word-wrap');

            var $editor = $this.ace({
                lang: $this.data('mode'),
                theme: $this.data('theme'),
                width: $this.closest('editor').width(),
            });

            if (wordWrap === 'yes' || wordWrap === '1') {
                $editor.data('ace')
                    .editor.ace.getSession()
                    .setUseWrapMode(true);
            }

            // Toggle fullscreen mode.
            $wrapper.find('[data-toggle="fullscreen"]')
                .on('click', function (e) {
                    e.preventDefault();

                    var $this = $(this);
                    var $group = $this.closest('.editor-field_type');
                    var $icon = $this.find('i');

                    // Fullscreen the field group.
                    $group.toggleClass('fullscreen');

                    // Resize or restore.
                    if ($group.hasClass('fullscreen')) {
                        $group
                            .find('.ace_editor, .ace_content')
                            .css('height', $(window).height())
                            .find('textarea').focus();

                        $icon
                            .toggleClass('fa-expand')
                            .toggleClass('fa-compress');

                        window.dispatchEvent(new Event('resize'));
                    } else {
                        $group
                            .find('.ace_editor, .ace_content')
                            .css(
                                'height',
                                $group.find('textarea').first().height()
                            );

                        $icon
                            .toggleClass('fa-expand')
                            .toggleClass('fa-compress');

                        window.dispatchEvent(new Event('resize'));
                    }
                });
        });
});
