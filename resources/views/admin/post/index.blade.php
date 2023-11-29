<x-admin title="Bài viết">
    <div class="row">
        <div class="col-lg-6">
            <a href="{{ route('admin.post.add') }}" class="btn btn-success text-light btn-sm shadow">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
            <a href="{{ route('admin.post') }}" class="btn btn-info text-light btn-sm shadow">
                <i class="fas fa-undo"></i> Làm mới
            </a>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
        </div>
    </div>
    <table class="table mt-3">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th class="w-50">Nội dung</th>
                <th>Tác giả</th>
                <th>Lượt xem</th>
                <th>Tạo Lúc</th>
                <th>Chức năng</th>                
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="d-flex">
                        <img src="/storage/post/{{$item->image}}" width="150" style="object-fit: cover;" class="rounded border border-1"  alt="">
                        <div class="content ms-3">
                            <p>{{$item->title}}</p>
                            <p class="text-secondary" style="font-size: 13px;">{{$item->description}}</p>
                        </div>
                    </td>
                    <td>{{$item->author->name}}</td>
                    <td><i class="fas fa-eye"></i> {{$item->views}}</td>
                    <td>{{$item->created_at->format('d/m/y H:i:s')}}</td>
                    <td>
                        <a href="{{route('admin.post.show',$item->id)}}" class="btn btn-sm btn-info shadow"><i class="fas fa-eye"></i></a>
                        <a href="{{route('admin.post.edit',$item->id)}}" class="btn btn-sm btn-warning shadow"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.post.delete',$item->id)}}" class="btn btn-sm btn-danger shadow"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>
