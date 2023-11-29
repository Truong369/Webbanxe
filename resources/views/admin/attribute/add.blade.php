<x-admin title="Thêm thuộc tính">
    <div class="row d-flex justify-content-between">
        <div class="col-lg-5 p-2 shadow">
            <h6 class="badge bg-info w-100 fs-6">Sản phẩm: {{$product_id->name}}</h6>
            <form action="{{route('admin.attribute.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="id_product" value="{{$product_id->id}}" hidden>
                <div class="field_wrapper">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Màu sắc</label>
                            <input type="text" class="form-control" placeholder="VD: Đen - Trắng" name="color[]" />
                            @error('color')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" class="form-control" placeholder="VD: 50" name="stock[]" />
                            @error('stock')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="width: 30%;">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="image[]" />
                            @error('image')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <a href="javascript:void(0);" class="add_button ms-1" title="Add field"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <button class="btn btn-sm btn-success">Thêm</button>
            </form>
        </div>
        <div class="col-lg-12 mt-4">
            <table class="table shadow mt-2">
                <thead class="bg-info text-light">
                    <tr>
                        <th>#</th>
                        <th>Màu sắc</th>
                        <th>Tồn kho</th>
                        <th>Ảnh</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_attr as $item)
                    <tr>
                        <td class="align-middle">
                            {{ $item->id }}
                        </td>
                        <td class="align-middle">
                            {{ $item->color }}
                        </td>
                        <td class="align-middle">
                            {{ $item->stock }}
                        </td>
                        <td class="align-middle">
                            <img src="{{asset('/storage/product_attr/'.$item->image)}}" class="img-thumbnail" style="object-fit: cover;" width="100" height="100" alt="">
                        </td>
                        <td class="align-middle">
                            <a href="{{route('admin.attribute.update',$item->id)}}" class="btn btn-sm btn-warning shadow">
                                Sửa
                            </a>
                            <a href="{{route('admin.attribute.delete',$item->id)}}" class="btn btn-sm btn-danger shadow">
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