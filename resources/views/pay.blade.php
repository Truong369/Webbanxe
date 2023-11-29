<x-only-header title="Thanh toán">
    <form action="{{ route('home.dathang') }}" method="POST">
        @csrf
        <div class="row shadow p-3 mt-3" style="background: #F6FBF4;">
            <div class="col-lg-5 border-end">
                <h5 class="fw-bold text-uppercase">Thông tin nhận hàng</h5>

                <x-input class="rounded-pill" value="{{ Auth::guard('customer')->user()->email }}" label="Email"
                    name="email" />
                <x-input class="rounded-pill" value="{{ Auth::guard('customer')->user()->fullName }}" label="Họ và tên"
                    name="fullName" />
                <x-input class="rounded-pill"  type="text"  value="{{ Auth::guard('customer')->user()->phone }}" label="Số điện thoại"
                    name="phone" />
                <x-input class="rounded-pill"  value="{{ Auth::guard('customer')->user()->address }}" label="Địa chỉ"
                    name="address" />
                 
                <x-textarea class="" name="note" label="Ghi chú" /> 
                <x-input value="{{ Auth::guard('customer')->user()->id }}" type="hidden" name="id_customer" />
                    <div class="form-group">
                        <label class="form-label">Phương thức thanh toán</label> <br>
                        <input type="radio" name="method" value="0" checked> <span class="badge bg-danger">Thanh toán khi nhận hàng</span>
                    </div>
            </div>
            <div class="col-lg-7">
                <h5 class="fw-bold text-uppercase">Đơn hàng ({{ $cart->total_quantity }} sản phẩm)</h5>
                <div>
                    @foreach ($cart->items as $item)
                    <div class="row d-flex align-items-center m-0 p-0 border-bottom mb-2 py-2">
                        <div class="col-lg-4">
                            <img src="/storage/images/{{ $item['image'] }}" width="60" alt="">
                        </div>
                        <div class="col-lg-4">
                            <h6>{{ $item['name'] }}</h6>
                        </div>
                        <div class="col-lg-4 text-center">
                            <h6 class="fw-bold text-danger">{{ number_format($item['price']) }}đ x
                                {{ $item['quantity'] }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12">
                <div class="text-end">
                    <h5 class="text-danger fw-bold my-3">Tổng cộng: {{ number_format($cart->total_price) }}đ</h5>
                    <a href="{{ route('home.giohang') }}" class="btn rounded-pill"
                        style="background: var(--red); color: white;"><i class="fas fa-arrow-left"></i>
                        Quay về trang giỏ hàng</a>
                    <button class="btn rounded-pill" style="background: var(--red); color: white;"><i
                            class="fas fa-check"></i> Đặt hàng</button>
                </div>
            </div>
        </div>
    </form>
</x-only-header>