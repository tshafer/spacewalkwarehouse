if ($('#fine-uploader-gallery').length > 0) {
    var endPoint = ($('#fine-uploader-gallery').parent().data('endpoint'));
    var deleteEndPoint = ($('#fine-uploader-gallery').parent().data('deletepoint'));
    $('#fine-uploader-gallery').fineUploader({
        template: 'qq-template-gallery',
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            sizeLimit: 51200 // 50 kB = 50 * 1024 bytes
        },
        deleteFile: {
            enabled: true,
            forceConfirm: true,
            endpoint: deleteEndPoint
        },
        session: {
            endpoint: endPoint
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
    });
}