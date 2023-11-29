<!doctype html>
<html lang="en">

<head>
    <title>{{$attributes['title']}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/home/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
</head>

<body>
    <span class="back-to-top">
        <i class="fas fa-chevron-circle-up"></i>
    </span>
    <header>
        <div class="container">
            <div class="row d-flex align-items-center py-2">
                <!-- Button Bars -->
                <div class="col-4 d-lg-none">
                    <label for="menu_toggle"><i class="fas fa-bars fs-5"></i></label>
                    <input type="checkbox" class="d-none" id="menu_toggle">
                    <!-- NavBar Mobile -->
                    <div id="nav_bar_mobile">
                        <label for="menu_toggle" class="text-end text-danger d-block mx-2 fs-3"><i
                                class="fas fa-times"></i></label>
                        <form id="form_search" class="d-flex justify-content-center mt-3"
                            action="{{route('home.search')}}">
                            <input placeholder="Bạn cần tìm gì?" name="key" id="input_search" type="text">
                            <button id="btn_search"><i class="fas fa-search"></i></button>
                        </form>
                        <ul style="list-style: none;">
                            <li class="my-3 border-bottom pb-2"><a class="text-decoration-none text-dark" href="">ĐĂNG
                                    NHẬP</a></li>
                            <li class="my-3 border-bottom pb-2"><a class="text-decoration-none text-dark" href="">TRANG
                                    CHỦ</a></li>
                            <li class="my-3 border-bottom pb-2"><a class="text-decoration-none text-dark"
                                    href="{{route('home.product')}}">SẢN
                                    PHẨM</a></li>
                            <li class="my-3 border-bottom pb-2"><a class="text-decoration-none text-dark" href="">GIỚI
                                    THIỆU</a></li>
                            <li class="my-3 border-bottom pb-2"><a class="text-decoration-none text-dark" href="{{route('home.contact')}}">LIÊN
                                    HỆ</a></li>
                            <li class="me-3"><a class="text-light text-decoration-none" href="{{route('home.news')}}"><i
                                        class="fas fa-earth"></i>
                                    TIN TỨC</a></li>
                        </ul>
                        <label for="menu_toggle">
                            <div class="overlay"></div>
                        </label>
                    </div>
                </div>
                <!-- Logo -->
                <div class="col-lg-4 col-4">
                    <img width="200" class="img-thumbnail border-0"
                        src="http://xedien.langsonweb.com/wp-content/uploads/2020/06/logo-xedien.png" alt="" id="logo">
                </div>
                <!-- Search -->
                <div class="col-lg-4 d-none d-lg-block">
                    <form id="form_search" class="d-flex justify-content-center" action="{{route('home.search')}}">
                        <input placeholder="Bạn cần tìm gì?" name="key" id="input_search" type="text">
                        <button id="btn_search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <!-- Login -->
                <div class="col-lg-4 col-4 d-flex justify-content-end">
                    <div class="header_login">
                        <ul class="d-flex m-0 p-0 align-items-center" style="list-style: none;">
                            @if(Auth::guard('customer')->user())
                            <li class="d-none d-lg-block account border border-1">
                                <button id="btn_login" class="btn btn-light  rounded-0" href="#">
                                    <img class="rounded-circle"
                                        src="{{asset('/storage/avatar/'.Auth::guard('customer')->user()->avatar)}}"
                                        width="25" height="25" alt="">
                                    {{Auth::guard('customer')->user()->fullName
                                    }}
                                </button>
                                <div class="dropdown_account">
                                    <ul class="m-0 p-0" style="list-style: none;">
                                        <li><a class="text-secondary" href="{{route('home.info')}}"><i
                                                    class="fas fa-info-circle"></i> Thông
                                                tin</a></li>
                                        <li class="mt-2"><a class="text-secondary" href="{{route('home.logout')}}"><i
                                                    class="fas fa-sign-out"></i> Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </li>

                            @else
                            <li class="d-none d-lg-block cart">
                                <a id="btn_login" class="btn btn-outline-dark rounded-0 text-decoration-none"
                                    href="{{route('home.login')}}">
                                    <span>Đăng Nhập</span>
                                    <i class="fas fa-lock"></i>
                                </a>
                            </li>
                            @endif
                            <li class="ms-3">
                                <a id="btn_cart" class="btn btn-danger rounded-0 text-decoration-none" href="{{route('home.giohang')}}">
                                    <span class="d-none d-lg-block">Giỏ Hàng <i class="fas fa-shopping-cart"></i>
                                        <sup>[{{$cart->total_quantity}}]</sup></span>
                                    <span class="d-lg-none d-md-block">
                                        <i class="fas fa-shopping-cart"></i> <sup>[$cart->total_quantity]</sup>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav id="nav_bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="d-none d-lg-flex m-0 px-0 py-2" style="list-style: none;">
                        <li class="me-3 border-end pe-3"><a class="text-light text-decoration-none"
                                href="{{route('home')}}"><i class="fas fa-home"></i> TRANG
                                CHỦ</a></li>
                        <li class="me-3 border-end pe-3"><a class="text-light text-decoration-none"
                                href="{{route('home.about')}}"><i class="fas fa-seedling"></i> GIỚI
                                THIỆU</a></li>
                        <li class="me-3 border-end pe-3"><a class="text-light text-decoration-none"
                                href="{{route('home.product')}}"><i class="fas fa-shopping-basket"></i> SẢN PHẨM</a>
                        </li>
                        <li class="me-3"><a class="text-light text-decoration-none" href="{{route('home.contact')}}"><i class="fas fa-phone"></i>
                                LIÊN HỆ</a></li>
                        <li class="me-3"><a class="text-light text-decoration-none" href="{{route('home.news')}}"><i
                                    class="fas fa-earth"></i>
                                TIN TỨC</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                @include('sweetalert::alert')
                {{$slot}}
            </div>
        </div>
    </section>
    <footer class="mt-3">
        <div style="background-color: var(--red);" class="d-none d-lg-block">
            <div class="row py-4 m-0">
                <div class="d-flex align-items-center justify-content-center">
                    <p class="text-light">Trả góp lãi suất ưu đãi <strong class="text-warning fs-2">0%</strong> tại quầy
                        thu ngân, thủ tục đơn giản!
                    </p>
                    <a href="" class="mx-5 text-decoration-none text-light rounded-5 btn btn-outline-light"><i
                            class="fas fa-search"></i> Xem Ngay</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-2 col-6 col-md-4">
                    <img width="200" class="img-thumbnail"
                        src="http://xedien.langsonweb.com/wp-content/uploads/2020/06/logo-xedien.png" alt="" id="logo">
                </div>
                <div class="col-lg-2 col-6 col-md-4 mb-3">
                    <ul class="m-0 p-0" style="list-style: none; font-size: 14px;">
                        <h6 class="text-danger fw-bold">Hướng Dẫn</h6>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Hướng dẫn đặt hàng</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Hình thức thanh toán</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Quy trình thực hiện</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Chính sách khách hàng</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 col-md-4 mb-3">
                    <ul class="m-0 p-0" style="list-style: none; font-size: 14px;">
                        <h6 class="text-danger fw-bold">Kiến thức</h6>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Đổi trả hàng</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Hướng dẫn trả góp</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Kiến thức Thương hiệu</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 col-md-4 mb-3">
                    <ul class="m-0 p-0" style="list-style: none; font-size: 14px;">
                        <h6 class="text-danger fw-bold">Tuyển dụng</h6>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Tuyển NV Marketing</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Tuyển Graphic Designer</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Tuyển NV biên tập nội dung</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Tuyển NV Tư vấn SP dịch vụ</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 col-md-4 mb-3">
                    <ul class="m-0 p-0" style="list-style: none; font-size: 14px;">
                        <h6 class="text-danger fw-bold">Cửa hàng</h6>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Địa chỉ: Đồng Tháp</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Điện thoại: 0922906635</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Email: truongkill1999@gmail.com</a>
                        </li>
                        <li>
                            <a href="" class="text-decoration-none text-secondary">Website: nhattruong.com.vn</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copy_right bg-dark">
            <div class="container">
                <div class="row py-2">
                    <div class="col-lg-12 text-center text-light">
                    © Copyright 2023 
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    @yield('script')
    <script src="{{asset('/home/js/main.js')}}"></script>
</body>

</html>