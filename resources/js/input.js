+(function (window, document) {
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

      var editor = CodeMirror.fromTextArea(textarea, {
        lineNumbers: true,
        lineWrapping: data.word_wrap,
        mode: data.mode || 'text/html',
        theme: data.theme || 'tomorrow-night-eighties',
        tabSize: data.tab_size || 2,
        indentWithTabs: data.tab_type === 'tabs',
        profile: 'xhtml',
        // allowDropFileTypes: ['jpg', 'png', 'gif'],
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

      document.querySelector('.CodeMirror').style.height = height;
      document.querySelector('.CodeMirror-scroll').style.fontSize = data.font_size + 'px';

      fullscreen.onclick = function (e) {
        e.preventDefault();
        editor.setOption('fullScreen', !editor.getOption('fullScreen'));
      };

      modeToggle.onchange = function (e) {
        editor.setOption('mode', e.target.value);
      };
    });
  });
})(window, document);
