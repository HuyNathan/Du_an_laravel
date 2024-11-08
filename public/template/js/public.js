$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore() {
    const page = parseInt($('#page').val()); // Đảm bảo page là số nguyên
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page: page }, // Truyền giá trị page
        url : '/services/load-product',
        success : function (result) {
            if (result.html !== '') {
                $('#loadProduct').append(result.html);
                $('#page').val(page + 1); // Tăng giá trị page sau mỗi lần load
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#button-loadMore').css('display', 'none'); // Ẩn nút nếu không còn sản phẩm
                
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText); // Debug lỗi nếu có
        }
    });
}

    document.querySelectorAll('.social-icon').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định
            const imageUrl = this.getAttribute('data-image');
            document.getElementById('popup-image').src = imageUrl; // Cập nhật đường dẫn hình ảnh
            document.getElementById('image-popup').style.display = 'block'; // Hiện hình ảnh
        });
    });

    // Ẩn hình ảnh khi nhấn vào ký hiệu "X"
    document.getElementById('close-popup').addEventListener('click', function() {
        document.getElementById('image-popup').style.display = 'none'; // Ẩn hình ảnh khi nhấn vào "X"
    });

    // Ẩn hình ảnh khi nhấn vào hình ảnh pop-up
    document.getElementById('image-popup').addEventListener('click', function() {
        this.style.display = 'none'; // Ẩn hình ảnh khi nhấn vào
    });
