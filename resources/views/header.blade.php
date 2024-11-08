<!-- Header -->
<header>

    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu" >

                        {!! $menusHtml !!}

                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <a href="/carts" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                       data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                    <a href="{{ route('user.login') }}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <i class="zmdi zmdi-account">
                            
                        </i>
                            @if(session('customer_name'))
                        <span class="customer-name" style="margin-left: 10px; font-size:14px"> <!-- Đổi màu chữ thành đen -->
                            {{ session('customer_name') }}
                        </span>
                    @endif <!-- Biểu tượng tài khoản -->
                    </a>
                    @if(session('customer_name'))
                    <form action="{{ route('user.logout') }}" method="POST" style="display:inline-block; margin-left: 10px;">
    @csrf
    <button type="submit" class="logout-icon" style="background: none; border: none; cursor: pointer;">
        <i class="fa fa-power-off"></i> <!-- Biểu tượng đăng xuất -->
    </button>
</form>

@endif

            
                
                </div>

            </nav>
        </div>
       
        </div>
    

        <!-- Button show menu -->
       
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu"><a href="{{ route('user.login') }}">Đăng Nhập</a></li> <!-- Cập nhật đường dẫn -->

            {!! $menusHtml !!}

            <li>
                <a href="contact.html">Contact</a>
            </li>
            <li>
                <a href="{{ route('user.login') }}">Đăng Nhập</a> <!-- Nút đăng nhập -->
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
