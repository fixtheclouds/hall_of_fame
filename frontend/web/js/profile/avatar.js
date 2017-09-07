$('#upload-mode').click(function () {
    var newText;
    if ($('.avatar-thumb').is(':visible')) {
        newText = 'Готово';
        $('.avatar-thumb').toggle();
        $('.field-profile-image').fadeToggle();
    } else {
        newText = 'Изменить фотографию';
        $('.avatar-thumb').fadeToggle();
        $('.field-profile-image').toggle();
    }
    $(this).text(newText);
});
