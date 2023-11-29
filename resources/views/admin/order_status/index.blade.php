<x-admin title="Trạng thái">
    <form action="{{ route('admin.order_status.store', $order_status_edit ? $order_status_edit->id : '') }}"
        method="post">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <x-input name="name" value="{{ $order_status_edit ? $order_status_edit->name : '' }}"
                    label="Tên trạng thái" />
                <div class="form-group">
                    <label class="form-label">Màu</label>
                    <input type="color" value="{{ $order_status_edit ? $order_status_edit->color : '' }}" name="color" class="form-control">
                </div>
                @if ($order_status_edit)
                    <a href="{{ route('admin.order_status') }}" class="btn btn-sm btn-secondary"><i
                            class="fas fa-arrow-left"></i> Trở lại</a>
                @endif
                <button class="btn btn-sm btn-success"><i class="fas fa-save"></i>
                    {{ $order_status_edit ? 'Cập nhật' : 'Lưu' }}</button>
            </div>
        </div>
    </form>
    <table class="table shadow mt-2">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Tên trạng thái</th>
                <th>Màu sắc</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_status as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <span class="badge" style="background: {{$item->color}}">{{ $item->name }}</span>
                    </td>
                    <td>
                        <div style="width: 30px; height: 30px; border-radius: 50%; background: {{ $item->color }};">
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.order_status', $item->id) }}" class="btn btn-sm shadow btn-warning"><i
                                class="fas fa-edit"></i></a>
                        <a href="{{ route('admin.order_status.delete', $item->id) }}"
                            class="btn btn-sm shadow btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>
