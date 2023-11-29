<x-admin title="Quản lý Role">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="{{ route('admin.role.store',$role ? $role->id : '') }}" method="post">
                @csrf
                <x-input value="{{$role ? $role->name : '' }}" name="name" label="Tên role" />
                @if ($role)
                    <a class="btn btn-secondary btn-sm" href="{{route('admin.role')}}">Trở lại</a>
                @endif
                <button class="btn btn-sm btn-success">Lưu</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-6 m-auto">
            <table class="table shadow-sm">
                <thead class="bg-info text-light">
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('admin.role', $item->id) }}" class="btn btn-sm btn-warning shadow"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.role.delete', $item->id) }}"
                                    class="btn btn-sm btn-danger shadow"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
