/**
 * Define a code mirror mode that uses html mixed,
 * and merges twig syntax into it.
 */
CodeMirror.defineMode("twig_html", function (config) {
    return CodeMirror.multiplexingMode(
        CodeMirror.getMode(config, "htmlmixed"), {
            open: /{[%{#]/, close: /[#}%]}/,
            mode: CodeMirror.getMode(config, "twig"),
            parseDelimiters: true
        }
    );
}, "htmlmixed");

$(document).on('ajaxComplete ready', function () {

    /**
     * Wait 1/10 seconds as a fix for
     * the grid / repeater field types.
     */
    setTimeout(function () {

        var editors = document.querySelectorAll(
            'textarea[data-provides="anomaly.field_type.editor"]:not([data-initialized])'
        );

        editors.forEach(function (textarea) {

            textarea.setAttribute('data-initialized', 'initialized');

            var data = textarea.dataset;
            var height = data.height + 'px';
            var wrapper = textarea.parentElement;

            var fullscreen = wrapper.querySelector('.fullscreen');

            /**
             * If twig is requested then use the fancy twig+html mode instead.
             */
            if (data.loader === 'twig') {
                data.loader = 'twig_html';
            }

            var editor = CodeMirror.fromTextArea(textarea, {
                profile: 'xhtml',
                lineNumbers: true,
                lineWrapping: data.word_wrap,
                mode: data.loader || 'htmlmixed',
                theme: data.theme || 'material',
                tabSize: data.tab_size || 4,
                indentUnit: 4,
                indentWithTabs: 'spaces',
                showCursorWhenSelecting: true,
                cursorScrollMargin: 2,
                cursorHeight: 0.95,
                lineWiseCopyCut: true,
                viewportMargin: Infinity,
                autoCloseBrackets: true,
                autoCloseTags: true,
                scrollbarStyle: null,
                highlightSelectionMatches: true,
                keyMap: 'phpstorm',
                lint: true,
                matchBrackets: true,
                styleActiveLine: false,
                gutters: ['CodeMirror-lint-markers'],
                extraKeys: {
                    "Ctrl-Space": "autocomplete",
                    F10: function (cm) {
                        cm.setOption('fullScreen', !cm.getOption('fullScreen'));
                    },
                    Esc: function (cm) {
                        var doc = cm.getDoc();
                        if (doc.getSelections().length > 1) {
                            cm.execCommand('singleSelection');
                        } else if (cm.getOption('fullScreen')) {
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

            $('[data-toggle="collapse"]').on('click', function () {
                setTimeout(function () {
                    editor.refresh();
                }, 100);
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                editor.refresh();
            });
        });
    }, 10);
});
