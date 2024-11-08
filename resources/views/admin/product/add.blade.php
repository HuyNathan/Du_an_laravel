@extends('admin.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Tên Sản Phẩm</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Gốc</label>
                    <input type="number" name="price" value="{{ old('price') }}"  class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Giảm</label>
                    <input type="number" name="price_sale" value="{{ old('price_sale') }}"  class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Mô Tả </label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
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

        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</form>
@endsection
@extends('admin.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Tên Sản Phẩm</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Gốc</label>
                    <input type="number" name="price" value="{{ old('price') }}"  class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Giảm</label>
                    <input type="number" name="price_sale" value="{{ old('price_sale') }}"  class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Mô Tả </label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
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

        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</form>
@endsection
