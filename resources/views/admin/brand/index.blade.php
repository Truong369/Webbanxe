<x-admin title="Hãng xe">
    <div class="row d-flex justify-content-between">
        <div class="col-lg-4">
            <form action="{{route('admin.brand.store',!empty($update_brand) ? $update_brand->id : "")}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($update_brand))
                <x-input name="name" value="{{$update_brand->name}}" label="Tên hãng" />
                <x-input name="image" label="Hình ảnh" type="file" />
                <a href="{{route('admin.brand')}}" class="btn btn-sm btn-dark">Trở lại</a>
                <button class="btn btn-sm btn-success">Cập nhật</button>
                @else
                <x-input name="name" label="Tên hãng" />
                <x-input name="image" label="Hình ảnh" type="file" />
                <button class="btn btn-sm btn-success">Thêm mới</button>
                @endif
            </form>
        </div>
        <div class="col-lg-8 mt-4">
            <table class="table shadow mt-2" id="vueDataProduct">
                <thead class="bg-info text-light">
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Tên</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brand as $item)
                    <tr>
                        <td class="align-middle">
                            {{ $item->id }}
                        </td>
                        <td class="align-middle" style="width: 100px; height: 100px;">
                            <img src="{{asset('/storage/brand/'.$item->image)}}" style="width: 100%; object-fit: cover"  alt="">
                        </td>
                        <td class="align-middle">
                            <span>{{ $item->name }}</span>
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('admin.brand', $item->id) }}" class="btn btn-sm btn-warning shadow">
                                Sửa
                            </a>
                            <a href="{{ route('admin.brand.delete', $item->id) }}" class="btn btn-sm btn-danger shadow">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>