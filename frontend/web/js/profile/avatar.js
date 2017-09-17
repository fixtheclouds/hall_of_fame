$('#upload-mode').click(function () {
    $(this).hide();
    $('.avatar-thumb').hide();
    $('.field-profile-image').fadeIn();
});

$('#avatar-upload input').on('fileuploaded', function(event, data, previewId, index) {
    console.log(data.response);
    if (typeof data.response.url !== 'undefined') {
        $('#my-avatar').attr('src', data.response.url);
        $('#upload-mode').show();
        $('.avatar-thumb').fadeIn();
        $('.field-profile-image').hide();
    }
});
