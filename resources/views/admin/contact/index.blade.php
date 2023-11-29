<x-admin title="Liên hệ">
    <table class="table">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Tên khách hàng</th>
                <th>Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contact as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td class="d-flex align-items-center">
                        <img src="/storage/avatar/{{ $item->customer->avatar }}" class="rounded-circle shadow-sm"
                            width="60" height="60" alt="">
                        <div>
                            <span class="ms-2">{{ $item->customer->fullName }}</span> <br>
                            <span class="ms-2">{{ $item->customer->email }}</span>
                        </div>
                    </td>
                    <td>
                        <p>{{ $item->content }}</p>
                    </td>
                    <td>
                        <a href="{{ route('admin.contact.delete', $item->id) }}" class="btn btn-sm shadow btn-danger"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-admin>
