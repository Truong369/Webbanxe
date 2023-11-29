<x-only-header title="Đơn hàng của bạn">
    <x-category-info>
        <table class="table table-bordered">
            <thead class="text-light bg-dark">
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $od)
                    @foreach ($od->order_detail as $odt)
                        <tr>
                            <td>{{ $od->id }}</td>
                            <td>{{ $odt->product->name }}</td>
                            <td>{{ $odt->quantity }}</td>
                            <td class="fw-bold">{{ number_format($odt->price) }}đ</td>
                            <td>{{ $od->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td>Tổng tiền:</td>
                    <td class="fw-bold text-danger">{{ number_format($total) }}đ</td>
                </tr>
            </tbody>
        </table>
    </x-category-info>
</x-only-header>
