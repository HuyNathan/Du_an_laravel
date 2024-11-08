@extends('admin.main')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Danh mục cha</th>
            <th>Hành động</th>
            <th>Ngày cập nhật</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->parent_id > 0 ? 'Danh mục con' : ' Danh mục cha' }}</td>
            <td>{{ $menu->active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
            <td>{{ $menu->updated_at }}</td>
            <td>
            <a href="#" onclick="openEditModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->parent_id }}, {{ $menu->active }});">
    <i class='bx bx-edit' style="font-size: 24px; cursor: pointer;"></i>
</a>


                <!-- Nút xóa -->
                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <i class='bx bxs-trash' style="font-size: 24px; color: red;"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Chỉnh sửa -->
<div class="modal" id="editModal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Chỉnh sửa danh mục</h2>
        <form id="editForm" action="{{ route('admin.menus.update', 'menu_id') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="menuId" value="">
            <div>
                <label for="menuName">Tên danh mục</label>
                <input type="text" name="name" id="menuName" required>
            </div>
            <div>
                <label for="parentId">Danh mục cha</label>
                <input type="number" name="parent_id" id="parentId">
            </div>
            <div>
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            </div>
            <div>
                <label for="content">Mô tả chi tiết</label>
                <textarea name="content" id="content" rows="4">{{ old('content') }}</textarea>
            </div>
            <div>
                <label for="active">Kích hoạt</label>
                <select name="active" id="active">
                    <option value="1">Có</option>
                    <option value="0">Không</option>
                </select>
            </div>
            <button type="submit">Lưu thay đổi</button>
        </form>
    </div>
</div>

@endsection

<script>
    function openEditModal(id, name, parent_id, active) {
        // Cập nhật giá trị trong form
        document.getElementById('menuId').value = id;
        document.getElementById('menuName').value = name;
        document.getElementById('parentId').value = parent_id;
        document.getElementById('active').value = active;

        // Mở modal
        document.getElementById('editModal').style.display = 'block';

        // Cập nhật action cho form
        document.getElementById('editForm').action = `/admin/menus/update/${id}`; // Cập nhật URL hành động
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Đóng modal khi nhấn bên ngoài modal
    window.onclick = function(event) {
        if (event.target === document.getElementById('editModal')) {
            closeEditModal();
        }
    }
</script>

<style>
    /* Ẩn modal theo mặc định */
    .modal {
        display: none; /* Ẩn modal theo mặc định */
        position: fixed; /* Đặt modal ở vị trí cố định */
        z-index: 1000; /* Đảm bảo modal ở trên cùng */
        left: 0;
        top: 0;
        width: 100%; /* Chiếm toàn bộ chiều rộng */
        height: 100%; /* Chiếm toàn bộ chiều cao */
        overflow: auto; /* Thêm cuộn nếu cần */
        background-color: rgba(0, 0, 0, 0.7); /* Nền tối với độ trong suốt */
    }

    /* Nội dung của modal */
    .modal-content {
        background-color: #fefefe; /* Màu nền cho modal */
        margin: auto; /* Căn giữa modal */
        padding: 20px; /* Khoảng cách nội dung */
        border: 1px solid #888; /* Đường viền modal */
        width: 80%; /* Chiều rộng của modal */
        max-width: 600px; /* Chiều rộng tối đa */
        border-radius: 8px; /* Bo góc cho modal */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng cho modal */
        position: relative; /* Để có thể căn giữa */
        top: 50%; /* Căn giữa theo chiều dọc */
        transform: translateY(-50%); /* Dịch chuyển lên để chính giữa */
    }

    /* Nút đóng modal */
    .close {
        color: #aaa; /* Màu cho nút đóng */
        float: right; /* Đặt ở bên phải */
        font-size: 28px; /* Kích thước chữ */
        font-weight: bold; /* Đậm */
    }

    .close:hover,
    .close:focus {
        color: black; /* Màu khi hover */
        text-decoration: none; /* Không gạch chân */
        cursor: pointer; /* Con trỏ chuột */
    }

    /* Các style cho form */
    form div {
        margin-bottom: 15px; /* Khoảng cách giữa các trường nhập liệu */
    }

    label {
        display: block; /* Hiển thị nhãn như khối */
        margin-bottom: 5px; /* Khoảng cách dưới nhãn */
    }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%; /* Chiều rộng đầy đủ */
        padding: 10px; /* Khoảng cách bên trong */
        border: 1px solid #ccc; /* Đường viền nhẹ */
        border-radius: 4px; /* Bo góc */
        box-sizing: border-box; /* Đảm bảo padding và border nằm trong chiều rộng */
        cursor: pointer;
    }

    /* Thêm CSS cho textarea mô tả và mô tả chi tiết */
    textarea {
        width: 100%; /* Chiều rộng đầy đủ */
        padding: 10px; /* Khoảng cách bên trong */
        border: 1px solid #ccc; /* Đường viền nhẹ */
        border-radius: 4px; /* Bo góc */
        box-sizing: border-box; /* Đảm bảo padding và border nằm trong chiều rộng */
        resize:  none; /* Cho phép người dùng thay đổi chiều cao */
        min-height: 5px; /* Chiều cao tối thiểu */
        height: 40px;
    }

    button {
        background-color: #007BFF; /* Màu nền cho nút */
        color: white; /* Màu chữ */
        padding: 10px 15px; /* Khoảng cách bên trong */
        border: none; /* Không có đường viền */
        border-radius: 4px; /* Bo góc */
        cursor: pointer; /* Con trỏ chuột */
    }

    button:hover {
        background-color: #45a049; /* Màu khi hover */
    }
</style>
