@extends('admin.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường dẫn</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control"  placeholder="Nhập url">
                    </div>
                </div>
            </div>

            <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="upload" data-input="thumb" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumb" class="form-control" type="text" name="thumb" value="{{ old('thumb') }}">
        </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Sắp xếp </label>
                        <input type="number" name="sort_by" value="1"  class="form-control" >
                    </div>
                </div>


            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Các trường nhập liệu khác -->
    
    <button type="submit" class="btn btn-primary">Thêm Slider</button>
</form>

<!-- js dùng để hiển thị trước ảnh  -->
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block'; // Hiển thị ảnh sau khi đã tải lên
        };
        reader.readAsDataURL(event.target.files[0]); // Đọc file ảnh
    }
</script>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    </form>
@endsection
