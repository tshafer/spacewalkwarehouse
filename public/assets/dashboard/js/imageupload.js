if ($('#fine-uploader-gallery').length > 0) {

    $('#fine-uploader-gallery').fineUploader({

        template: 'qq-template-gallery',

        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            sizeLimit: 512000 // 50 kB = 50 * 1024 bytes
        },
        retry: {
            enableAuto: true
        },
        resume: {
            enabled: true
        },
        onAllComplete: function (e) {
            console.log(e);
        }
    }).on('complete', function (event, id, name, responseJSON) {
        location.reload();
    });
}