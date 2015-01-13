$(document).ready(function () {

    $('.ace-editor').each(function () {

        var lang = $(this).data('mode');

        $(this).ace({lang: lang});
    });
});