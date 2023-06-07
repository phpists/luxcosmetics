let summernoteDefaultOptions = {
    callbacks: {
        onImageUpload: function(files) {
            let $summernote = $(this);

            uploadImage(files[0], function(data) {
                $summernote.summernote('insertImage', data);
            });
        },
        onMediaDelete: function(target) {
            var filename = target[0].src.split('/').pop();
            deleteImage(filename, function(response) {
                console.log(response);
            });
        }
    }
};

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
function uploadImage(file, callback) {
    var formData = new FormData();
    formData.append('file', file);
    $.ajax({
        url: '/uk/admin/summernote/upload',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            callback(data);
        },
        error: function() {
            alert('Error uploading image');
        }
    });
}

function deleteImage(filename, callback) {
    $.ajax({
        url: '/uk/admin/summernote/delete',
        data: {
            filename: filename
        },
        method: 'DELETE',
        success: function(response) {
            callback(response);
        },
        error: function() {
            alert('Error deleting image');
        }
    });
}
