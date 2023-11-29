<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $attributes['title'] }}</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('/ad/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/ad/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/ad/dist/css/adminlte.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="/awesome-notifications/style.css" />
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = `<div class="d-flex justify-content-between align-items-center">
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Màu sắc</label>
                            <input type="text" class="form-control" placeholder="VD: Đen - Trắng" name="color[]" />
                        </div>
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" class="form-control" placeholder="VD: 50" name="stock[]" />
                        </div>
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="image[]" />
                        </div>
                        <a href="javascript:void(0);" class="add_button ms-1" title="Add field"><i
                                class="fas fa-plus"></i></a>
                    </div>`; //New input field html 
            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="#app">
        <div class="wrapper" id="admin-wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-light navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto d-flex align-items-center">
                    <li class="nav-item">
                        <img src="/storage/avatar/{{ Auth::user()->avatar ?? '' }}" class="rounded-circle shadow-sm"
                            width="40" height="40" alt="">
                    </li>
                    <li class="nav-item mx-2">
                        <a href="" class="text-decoration-none text-dark">
                            <span>
                                {{ Auth::user()->fullname ?? 'Lensko' }}
                            </span>
                        </a>/
                        <a class="text-decoration-none text-dark me-3" href="{{ route('admin.logout') }}">Đăng xuất
                            <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>

            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4"
                style="background: url('https://i.pinimg.com/originals/52/f7/2f/52f72fa99a5907ba80e4b0da3d518f2d.jpg'); background-size: cover;">
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="mt-3 ms-3 pb-3 mb-3 d-flex align-items-center">
                        <img src="/storage/avatar/{{ Auth::user()->avatar ?? 'default.png' }}"
                            class="rounded-circle shadow-sm" width="40" height="40">
                        <span class="ms-2 fw-bold text-light">
                            {{ Auth::user()->fullname ?? 'Lensko' }}
                        </span>
                    </div>

                    <!-- SidebarSearch Form -->

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chalkboard"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-basket"></i>
                                    <p>
                                        Sản phẩm
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.product') }}" class="nav-link">
                                            <i class="nav-icon fas fa-stream"></i>
                                            <p>
                                                Danh sách
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.category') }}" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>
                                                Danh mục
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.brand') }}" class="nav-link">
                                            <i class="nav-icon fas fa-car"></i>
                                            <p>
                                                Hãng xe
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.order_status') }}" class="nav-link">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Trạng thái
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.order') }}" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Đơn hàng
                                    </p>
                                </a>
                            </li>
                            @if (Auth::user()->role->id == 2)
                            <li class="nav-item">
                                <a href="{{ route('admin.role') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield"></i>
                                    <p>
                                        Role
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-astronaut"></i>
                                    <p>
                                        Nhân viên
                                    </p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('admin.customer') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Khách hàng
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.post') }}" class="nav-link">
                                    <i class="nav-icon fas fa-signature"></i>
                                    <p>
                                        Bài viết
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.comment') }}" class="nav-link">
                                    <i class="nav-icon fas fa-comment"></i>
                                    <p>
                                        Bình luận
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.banner') }}" class="nav-link">
                                    <i class="nav-icon fas fa-image"></i>
                                    <p>
                                        Banner
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.about') }}" class="nav-link">
                                    <i class="nav-icon fas fa-seedling"></i>
                                    <p>
                                        Giới thiệu
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.contact') }}" class="nav-link">
                                    <i class="nav-icon fas fa-phone"></i>
                                    <p>
                                        Liên hệ
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>

            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content py-3">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h3 class="card-title badge bg-dark">{{ $attributes['title'] }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"
                                                title="Remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="app">
                                            @include('sweetalert::alert')
                                            {{ $slot }}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/ad/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/ad/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/ad/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="/awesome-notifications/index.var.js"></script>
    {{-- Ckeditor --}}
    <script src="/js/app.js"></script>
    @yield('script')
</body>

</html>