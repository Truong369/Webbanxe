<x-admin title="Chi tiết đơn hàng">
    <table class="table shadow mt-2">
        <thead class="bg-info text-light">
            <tr>
                <th>Đơn hàng</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tạo lúc</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $item)
                <tr>
                    <td>{{ $item->id_order }}</td>
                    <td>
                        <img src="/storage/images/{{ $item->product->image }}" class="border me-3" width="50"
                            alt="">
                        {{ $item->product->name }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td class="fw-bold">{{ number_format($item->price) }}đ</td>
                    <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.order') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>Trở lại</a>
</x-admin>
