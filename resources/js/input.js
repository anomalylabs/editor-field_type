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
        
        var $dragArea = $('.ace_content');

        $dragArea.on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.originalEvent.dataTransfer.dropEffect = 'copy';
        });

        $dragArea.on('dragenter', function (e) {
            $(e.target).css({ backgroundColor: 'rgba(103, 58, 183, 0.5)' });
        });

        $dragArea.on('dragleave', function (e) {
            $(e.target).css({ backgroundColor: 'transparent' });
        });

        $dragArea.on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            var files = e.originalEvent.dataTransfer.files;
            var output = [];
            var $list = $('<div/>').attr('id', 'list').appendTo($(this).closest('.editor'));

            for (var i = 0, f; f = files[i]; i++) {
                output.push(
                    '<li><strong>', escape(f.name),
                    '</strong> (', f.type || 'n/a', ') - ', f.size,
                    ' bytes, last modified: ',
                    f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                    '</li>'
                );
            }

            document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';

            $(e.target).css({ backgroundColor: 'transparent' });
        });
    });
});
