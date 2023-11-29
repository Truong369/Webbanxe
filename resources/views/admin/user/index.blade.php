<x-admin title="User">
    <div class="row">
        <div class="col-lg-6">
            <a href="{{route('admin.user.add')}}" class="btn btn-success text-light btn-sm shadow">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
            <a href="{{route('admin.user')}}" class="btn btn-info text-light btn-sm shadow">
                <i class="fas fa-undo"></i> Làm mới
            </a>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
        </div>
    </div>
    <table class="table shadow mt-2">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Chức vụ</th>
                <th>Tạo lúc</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="d-flex align-items-center">
                        <img src="/storage/avatar/{{$item->avatar}}" class="rounded-circle shadow-sm" width="60" height="60" alt="">
                        <div>
                            <span class="ms-2">{{$item->fullname}}</span> <br>
                            <span class="ms-2">{{$item->email}}</span>
                        </div>
                    </td>
                    <td>{{$item->role->name}}</td>
                    <td>{{$item->created_at->format('d/m/y H:i:s')}}</td>
                    <td>
                        <a href="{{route('admin.user.edit',$item->id)}}" class="btn btn-sm btn-warning shadow"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.user.delete',$item->id)}}" class="btn btn-sm btn-danger shadow"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>