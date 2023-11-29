<x-only-header title="Đăng nhập">
    <div class="row my-5">
        <div class="col-5 m-auto">
            <form action="{{route('home.login.store')}}" method="post">
                @csrf
                <div class="card p-4">
                    <h5 class="text-danger text-center fw-bold">Đăng nhập</h5>
                    <x-input name="email" label="Email"/>
                    <x-input name="password" type="password" label="Mật khẩu"/>
                    <button class="btn btn-dark w-100 mt-3">Đăng nhập</button>
                    <span class="text-center mt-3">Chưa có tài khoản? <a href="{{route('home.register')}}" >Đăng ký</a></span>
                </div>
            </form>
        </div>
    </div>
</x-only-header>
