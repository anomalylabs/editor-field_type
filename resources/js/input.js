$(document).on('ajaxComplete ready', function () {

    var editors = document.querySelectorAll(
        'textarea[data-provides="anomaly.field_type.editor"]:not([data-initialized])'
    );

    editors.forEach(function (textarea) {

        textarea.setAttribute('data-initialized', 'initialized');

        var data = textarea.dataset;
        var height = data.height + 'px';
        var wrapper = textarea.parentElement;

        var fullscreen = wrapper.querySelector('.fullscreen');

        var editor = CodeMirror.fromTextArea(textarea, {
            profile: 'xhtml',
            lineNumbers: true,
            lineWrapping: data.word_wrap,
            mode: data.mode || 'twig',
            theme: data.theme || 'material',
            tabSize: data.tab_size || 4,
            indentWithTabs: 'spaces',
            showCursorWhenSelecting: true,
            cursorScrollMargin: 2,
            cursorHeight: 0.95,
            lineWiseCopyCut: false,
            viewportMargin: Infinity,
            //allowDropFileTypes: ['image/jpg', 'image/png', 'image/gif'],
            autoCloseBrackets: true,
            highlightSelectionMatches: true,
            keyMap: 'phpstorm',
            lint: true,
            matchBrackets: true,
            styleActiveLine: false,
            gutters: ['CodeMirror-lint-markers'],
            extraKeys: {
                F10: function (cm) {
                    cm.setOption('fullScreen', !cm.getOption('fullScreen'));
                },
                Esc: function (cm) {
                    if (cm.getOption('fullScreen')) {
                        cm.setOption('fullScreen', false);
                    }
                }
            }
        });

        emmetCodeMirror(editor);

        var cm = document.querySelector('.CodeMirror');
        var cmScroll = document.querySelector('.CodeMirror-scroll');

        cm.style.height = 'auto';
        cm.style.minHeight = height;
        cmScroll.style.minHeight = height;

        fullscreen.onclick = function (e) {
            e.preventDefault();
            e.target.parentElement.classList.toggle('expanded');
            editor.setOption('fullScreen', !editor.getOption('fullScreen'));
        };

        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            editor.refresh();
        })
    });
});
