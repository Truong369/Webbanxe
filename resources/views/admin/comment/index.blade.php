<x-admin title="Bình luận">
    <table class="table mt-3">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Nội dung</th>
                <th>Bài viết</th>
                <th>Chức năng</th>                
            </tr>
        </thead>
        <tbody>
            @foreach ($comment as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="d-flex align-items-center">
                        <img src="/storage/avatar/{{$item->customer->avatar}}" class="rounded-circle shadow-sm" width="60" height="60" alt="">
                        <div>
                            <span class="ms-2">{{$item->customer->fullName}}</span> <br>
                            <span class="ms-2">{{$item->customer->email}}</span>
                        </div>
                    </td>
                    <td>{{$item->content}}</td>
                    <td><a href="{{route('home.new_detail',$item->post->id)}}">Xem trang <i class="fas fa-paperclip"></i></a></td>
                    <td>
                        <a href="{{route('admin.comment.delete',$item->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>