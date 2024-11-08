@extends('admin.main') 

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <strong>Tổng số lượng khách hàng:</strong> {{ $customerCount }} <!-- Hiển thị số lượng khách hàng -->
            </div>
        </div>
    </div>
    <div class="row"> <!-- begin::Row -->
        @foreach ($menus as $menu)
            <div class="col-lg-3 col-6"> <!-- begin::Small Box Widget -->
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $menu->products_count }}</h3> <!-- Số lượng sản phẩm trong danh mục -->
                        <p>{{ $menu->name }}</p> <!-- Tên danh mục -->
                    </div> 
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div> <!-- end::Small Box Widget -->
            </div> <!-- end::Col -->
        @endforeach
    </div> <!-- end::Row -->
    
    
@endsection  
