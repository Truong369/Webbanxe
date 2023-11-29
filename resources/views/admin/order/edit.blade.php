<x-admin title="Cập nhật đơn hàng">
    <form action="{{ route('admin.order.store', $order->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <x-input value="{{ $order->customer->email }}" label="Email" name="email" />
                <x-input value="{{ $order->customer->fullName }}" label="Họ và tên" name="fullName" />
                <x-input value="{{ $order->phone }}" label="Số điện thoại" name="phone" />
                <x-input value="{{ $order->customer->address }}" label="Địa chỉ" name="address" />
            </div>
            <div class="col-lg-6">
                <x-input value="{{ $order->total }}" label="Tổng tiền" name="total" />
                <div class="form-group">
                    <label class="form-label">Trạng thái đơn hàng</label>
                    <select name="id_status" class="form-select">
                        <option selected disabled>Chọn trạng thái đơn hàng</option>
                        @foreach ($order_status as $item)
                            <option {{ $item->id == $order->id_status ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                        @error('id_status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </select>
                </div>
                <a href="{{ route('admin.order') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>
                    Trở lại</a>
                <button class="btn btn-sm btn-success"><i class="fas fa-save"></i> Lưu</button>
            </div>
        </div>
    </form>
</x-admin>
