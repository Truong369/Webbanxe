<x-only-header title="Đăng kí tài khoản">
    <div class="row my-5">
        <div class="col-5 m-auto">
            <form action="{{route('home.register.store')}}" method="post">
                @csrf
                <div class="card p-4">
                    <h5 class="text-danger text-center fw-bold">Đăng ký</h5>
                    <x-input name="fullName" label="Họ và tên"/>
                    <x-input name="phone" label="Số điện thoại"/>
                    <x-input name="email" label="Email"/>
                    <x-input name="password" type="password" label="Mật khẩu"/>
                    <x-input name="confirm_password" type="password" label="Nhập lại mật khẩu"/>
                    <button class="btn btn-dark w-100 mt-3">Đăng ký</button>
                    <span class="text-center mt-3">Đã có tài khoản? <a href="{{route('home.login')}}" >Đăng nhập</a></span>
                </div>
            </form>
        </div>
    </div>
</x-only-header>
