$(function () {

    $('.ace-editor').each(function () {

        var lang = $(this).data('mode');
        var theme = $(this).data('theme');

        $(this).ace({lang: lang, theme: theme});
    });
});
