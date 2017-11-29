(function (window, document) {
  /**
   * Define a code mirror mode that uses html mixed,
   * and merges twig syntax into it.
   */
  CodeMirror.defineMode(
    'twig_html',
    function (config) {
      return CodeMirror.multiplexingMode(
        CodeMirror.getMode(config, 'htmlmixed'), {
          open: /{[%{#]/,
          close: /[#}%]}/,
          mode: CodeMirror.getMode(config, 'twig'),
          parseDelimiters: true,
        }
      );
    },
    'htmlmixed'
  );

  document.addEventListener('DOMContentLoaded', function () {

    const textareas = document.querySelectorAll(
      'textarea[data-provides="anomaly.field_type.editor"]'
    );

    textareas.forEach(function (textarea) {

      const data = textarea.dataset;
      const height = data.height + 'px';
      const wrapper = textarea.parentElement;
      const fullscreen = wrapper.querySelector('.fullscreen');

      if (data.loader === 'twig') {
        data.loader = 'twig_html';
      }

      let editor = CodeMirror.fromTextArea(textarea, {
        profile: data.profile || 'xhtml',
        lineNumbers: data.line_numbers || true,
        lineWrapping: data.word_wrap || true,
        mode: data.loader || 'htmlmixed',
        theme: data.theme || 'material',
        tabSize: data.tab_size || 2,
        indentUnit: data.indent_unit || 2,
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
        keyMap: 'sublime',
        lint: true,
        matchBrackets: true,
        styleActiveLine: true,
        gutters: ['CodeMirror-lint-markers'],
        extraKeys: {
          'Ctrl-Space': 'autocomplete',

          'F10': function (cm) {
            cm.setOption('fullScreen', !cm.getOption('fullScreen'));
            fullscreen.classList.toggle('expanded');
          },

          'Esc': function (cm) {
            const doc = cm.getDoc();

            if (doc.getSelections().length > 1) {
              cm.execCommand('singleSelection');
            } else if (cm.getOption('fullScreen')) {
              cm.setOption('fullScreen', false);
            }

            fullscreen.classList.toggle('expanded');
          },
        },
      });

      emmetCodeMirror(editor);

      const cm = document.querySelector('.CodeMirror');
      const cmScroll = document.querySelector('.CodeMirror-scroll');

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
  });
})(window, document);
