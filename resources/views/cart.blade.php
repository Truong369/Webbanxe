<x-only-header title="Giỏ hàng">
    <div class="row py-3">
        <h5 class="text-uppercase">Giỏ hàng của bạn</h5>
        @if (!empty($cart->items))
        <table class="table table-borderless table-bordered table-hover">
            <thead class="text-light" style="background: var(--red);">
                <tr class="text-center">
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>
                <tr></tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                ?>
                @foreach ($cart->items as $item)
                <tr style="vertical-align: middle; text-align: center;">
                    <td>{{ $i++ }}</td>
                    <td>
                        <p class="fw-bold mb-1">{{ $item['name'] }}</p>
                    </td>
                    <td>
                        @if (empty($item['color']))
                        <img src="/storage/images/{{ $item['image'] }}" alt="" width="100"
                            class="img-thumbnail border-0" />
                        @else
                        <img src="/storage/product_attr/{{ $item['color'] }}" alt="" width="100"
                            class="img-thumbnail border-0" />
                        @endif
                    </td>
                    <td>
                        <p class="text-danger fw-bold mb-0">{{ number_format($item['price']) }}đ</p>
                    </td>
                    <td style="width: 200px;">
                        <form action="{{ route('home.giohang.update') }}" method="POST" class="d-flex">
                            @csrf
                            <div>
                                <input type="hidden" value="{{ $item['id'] }}" name="id_product" class="form-control">
                                <input type="number" value="{{ $item['quantity'] }}" min="1" name="quantity"
                                    class="form-control">
                            </div>
                            <button class="btn btn-sm" style="background: var(--red); color: white;">Lưu</button>
                        </form>
                    </td>
                    <td class="fw-bold">{{ number_format($item['price'] * $item['quantity']) }}đ</td>
                    <td>
                        <a class="btn btn-sm btn-danger" href="{{ route('home.giohang.remove', $item['id']) }}"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                <tr class="text-center">
                    <td colspan="5"></td>
                    <td>Tổng tiền:</td>
                    <td class="fw-bold text-danger">{{ number_format($cart->total_price) }}đ</td>
                </tr>
            </tbody>
        </table>
        <div class="text-end">
            <a href="{{ route('home') }}" class="btn rounded-pill" style="background: var(--red); color: white;"><i
                    class="fas fa-arrow-left"></i>
                Tiếp tục mua hàng</a>
            <a href="{{ route('home.thanhtoan') }}" class="btn rounded-pill"
                style="background: var(--red); color: white;"><i class="fas fa-check"></i> Thanh toán</a>
        </div>
        @else
        <p class="text-center">Chưa có sản phẩm nào trong giỏ hàng!</p>
        <a href="{{ route('home') }}" class="btn rounded-pill" style="background: var(--red); color: white;"><i
                class="fas fa-arrow-left"></i>
            Tiếp tục mua hàng</a>
        @endif
    </div>
</x-only-header>