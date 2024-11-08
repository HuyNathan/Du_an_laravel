$('#upload').change(function () {
    var formData = new FormData();
    formData.append('file', $('#upload')[0].files[0]);

    $.ajax({
        url: '/admin/upload/services',  // Đường dẫn đến UploadController
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                $('#image_show').html('<a href="' + response.url + '" target="_blank">' +
                    '<img src="' + response.url + '" width="100px"></a>');
                $('#thumb').val(response.url);  // Gán giá trị URL ảnh vào input hidden 'thumb'
            } else {
                alert('Upload failed, please try again.');
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
    
});


function removeRow(id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        $.ajax({
            url: url + '/' + id,
            type: 'DELETE',
            data: {
                id: id,
                _token: '{{ csrf_token() }}' // Thêm token CSRF để bảo mật
            },
            success: function(response) {
                if (!response.error) {
                    // Làm mới trang hoặc xóa hàng khỏi bảng
                    location.reload();
                } else {
                    alert(response.message || 'Có lỗi xảy ra khi xóa sản phẩm');
                }
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi xóa sản phẩm: ' + xhr.responseText);
            }
        });
    }
}


