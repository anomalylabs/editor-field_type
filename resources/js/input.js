/*global emmetCodeMirror CodeMirror*/
/*eslint semi: 0*/

+(function (window, document, emmetCodeMirror, CodeMirror) {
  document.addEventListener('DOMContentLoaded', function () {
    var textareas = document.querySelectorAll(
      'textarea[data-provides="anomaly.field_type.editor"]'
    );

    textareas.forEach(function (textarea) {
      var wrapper = textarea.parentElement;
      var data = textarea.dataset;
      var height = data.height > 0 ? data.height + 'px' : 'auto';

      var fullscreen = wrapper.querySelector('.fullscreen');
      var modeToggle = wrapper.querySelector('.code-mode-changer');
      var themeToggle = wrapper.querySelector('.code-theme-changer');

      var editor = CodeMirror.fromTextArea(textarea, {
        lineNumbers: true,
        lineWrapping: data.word_wrap,
        mode: data.mode || 'text/html',
        theme: data.theme || 'tomorrow-night-eighties',
        tabSize: data.tab_size || 2,
        indentWithTabs: data.tab_type === 'tabs',
        profile: 'xhtml',
        showCursorWhenSelecting: true,
        cursorScrollMargin: 2,
        cursorHeight: 0.95,
        lineWiseCopyCut: false,
        allowDropFileTypes: ['image/jpg', 'image/png', 'image/gif'],
        autoCloseBrackets: true,
        highlightSelectionMatches: true,
        keyMap: data.keymap || 'sublime',
        lint: true,
        matchBrackets: true,
        styleActiveLine: false,
        gutters: ['CodeMirror-lint-markers'],
        extraKeys: {
          F11: function (cm) {
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

      cm.style.height = height;
      cmScroll.style.fontSize = data.font_size + 'px';

      fullscreen.onclick = function (e) {
        e.preventDefault();
        e.target.parentElement.classList.toggle('expanded');
        editor.setOption('fullScreen', !editor.getOption('fullScreen'));
      };

      modeToggle.onchange = function (e) {
        editor.setOption('mode', e.target.value);
      };

      themeToggle.onchange = function (e) {
        editor.setOption('theme', e.target.value);
      };
    });
  });
})(window, document, emmetCodeMirror, CodeMirror);
