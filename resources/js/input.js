$(document).ready(function () {

    $('.ace-editor').each(function () {

        var lang = $(this).data('lang');

        $(this).ace({ lang: lang });
    });
});