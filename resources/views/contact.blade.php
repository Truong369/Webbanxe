<x-only-header title="Liên hệ">
    @section('style')
        <style>
            .form-contact {
                border: 1px solid gray;
                width: 100%;
                padding: 15px;
                border-radius: 50px;
                outline: none;
                font-size: 14px;
                margin-bottom: 20px;
            }

            .btn-contact {
                background: #4797B1;
                border: none;
                padding: 10px 15px;
                color: white;
                border-radius: 50px;
            }
        </style>
    @stop
    <form action="{{ route('home.contact.store') }}" method="POST">
        @csrf
        <div class="row py-3">
            <div class="col-lg-6">
                <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14611.411485162975!2d105.73404003119275!3d10.007023662207729!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08903d92d1d0d%3A0x2c147a40ead97caa!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBOYW0gQ-G6p24gVGjGoQ!5e1!3m2!1svi!2s!4v1665277362496!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-6">
                <h2>GỬI THÔNG TIN CHO CHÚNG TÔI</h2>
                <p>Hãy liên hệ ngay với chúng tôi để nhận được nhiều ưu đãi hấp dẫn dành cho bạn!</p>
                <input type="hidden" name="id_customer" value="{{ Auth::guard('customer')->user()->id ?? '' }}">
                <div class="form-group mb-3">
                    <input class="form-control" type="text" name="firstName"
                        value="{{ Auth::guard('customer')->user()->firstName ?? old('fullName') }}" placeholder="Tên">
                    @error('firstName')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="text" name="lastName"
                        value="{{ Auth::guard('customer')->user()->lastName ?? old('lastName') }}" placeholder="Họ">
                    @error('lastName')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="phone" name="email"
                        value="{{ Auth::guard('customer')->user()->email ?? old('email') }}" placeholder="Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="text" name="phone"
                        value="{{ Auth::guard('customer')->user()->phone ?? old('phone') }}" placeholder="Điện thoại">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control" placeholder="Nội dung" name="content"></textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn-sm btn btn-success">
                    Gửi thông tin
                </button>
            </div>
        </div>
    </form>
</x-only-header>
