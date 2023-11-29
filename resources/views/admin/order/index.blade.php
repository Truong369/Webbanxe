<x-admin title="Đơn hàng">
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" name="key" placeholder="Tìm kiếm theo tên, số điện thoại..." class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-sm btn-primary h-100">Tìm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table shadow mt-2">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Ghi chú</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if(count($order) > 0)
            @foreach ($order as $item)
            <tr>
                <td style="vertical-align: middle;">{{ $item->id }}</td>
                <td style="vertical-align: middle;" class="d-flex align-items-center">
                    <img src="/storage/avatar/{{ $item->customer->avatar }}" class="rounded-circle shadow-sm" width="60" height="60" alt="">
                    <div>
                        <span class="ms-2">{{ $item->fullName }}</span> <br>
                        <span class="ms-2">{{ $item->email }}</span> <br>
                        <span class="ms-2" style="font-size: 13px;">{{ $item->phone }}</span>
                    </div>
                </td>
                <td style="vertical-align: middle;">{{ $item->note }}</td>
                <td style="vertical-align: middle;" class="fw-bold">{{ number_format($item->total) }}đ</td>
                <td style="vertical-align: middle;">{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                <td style="vertical-align: middle;">
                    <span class="badge" style="background: {{$item->order_status->color}}">{{$item->order_status->name}}</span>
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('admin.order.detail', $item->id) }}" class="btn btn-sm btn-info shadow">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.order.edit', $item->id) }}" class="btn btn-sm btn-warning shadow">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.order.delete', $item->id) }}" class="btn btn-sm btn-danger shadow">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="text-center">Không tìm thấy đơn hàng</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if(!empty($_REQUEST['key']))
    <a href="{{route('admin.order')}}" class="btn btn-sm btn-dark">Trở lại</a>
    @endif
</x-admin>