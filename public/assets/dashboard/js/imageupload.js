if ($('#fine-uploader-gallery').length > 0) {
    var endpoint = $('#fine-uploader-gallery').parent().prop('action');
    $('#fine-uploader-gallery').fineUploader({

        template: 'qq-template-gallery',
        request: {
            endpoint: endpoint
        },
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
        callbacks: {
            onAllComplete: function (e) {
                location.reload();
            }
        }
    });
}

if ($('#accessory-uploader-gallery').length > 0) {
    var endpoint = $('#accessory-uploader-gallery').parent().prop('action');
    $('#accessory-uploader-gallery').fineUploader({

        template: 'qq-template-gallery',
        request: {
            endpoint: endpoint
        },
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
        callbacks: {
            onAllComplete: function (e) {
                location.reload();
            }
        }
    });
}