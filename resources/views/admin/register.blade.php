{{-- <!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/home/css/login.css">
    <style>
        body {
            background: url('https://www.sailsrestaurants.com/_cms3/wwwroot/adminPublicFiles/design/cms3admin-background-01.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .box {
            width: 400px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #EDEDED;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 20px #333;
        }
    </style>
</head>

<body>
    <div class="box">
        <form action="{{ route('admin.store_register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-item">
                <h4>Đăng ký Admin</h4>
                <input name="fullName" value="{{ old('fullName') }}" placeholder="Họ tên" type="text">
                @error('fullName')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <input name="email" value="{{ old('email') }}" placeholder="Email" type="email">
                @error('email')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <input name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại" type="phone">
                @error('phone')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <input name="address" value="{{ old('address') }}" placeholder="Địa chỉ" type="address">
                @error('address')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <input name="password" value="{{ old('password') }}" placeholder="Mật khẩu" type="password">
                @error('password')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <input name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Nhập lại mật khẩu"
                    type="password">
                @error('confirm_password')
                    <span style="color: red; font-size: 13px;">{{ $message }}</span>
                @enderror
                <button>ĐĂNG KÝ</button>
                <p>Đã có tài khoản, đăng nhập <a href="{{ route('admin.login') }}" class="text-decoration-none">tại
                        đây</a></p>
            </div>
        </form>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('/login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{route('admin.store_register')}}">
                    @csrf
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<div class="wrap-input100">
						<input class="input100" type="text" name="fullName">
						<span class="focus-input100" data-placeholder="Họ tên"></span>
                        @error('fullName')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>
					<div class="wrap-input100">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
                        @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>
					<div class="wrap-input100">
						<input class="input100" type="text" name="phone">
						<span class="focus-input100" data-placeholder="Điện thoại"></span>
                        @error('phone')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>
					<div class="wrap-input100">
						<input class="input100" type="text" name="address">
						<span class="focus-input100" data-placeholder="Địa chỉ"></span>
                        @error('address')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>

					<div class="wrap-input100">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
                        @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>
					<div class="wrap-input100">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="confirm_password">
						<span class="focus-input100" data-placeholder="Nhập lại mật khẩu"></span>
                        @error('confirm_password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Đăng ký
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Bạn đã có tài khoản?
						</span>

						<a class="txt2" href="{{route('admin.login')}}">
							Đăng nhập
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/login/js/main.js')}}"></script>

</body>
</html>