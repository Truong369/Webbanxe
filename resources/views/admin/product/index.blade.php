<x-admin title="Sản phẩm">
    {{-- <product-component></product-component> --}}
    <div class="row d-flex justify-content-between">
        <div class="col-lg-6">
            <a href="{{ route('admin.product.add') }}" class="btn btn-success text-light btn-sm shadow">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
            <a href="{{ route('admin.product') }}" class="btn btn-info text-light btn-sm shadow">
                <i class="fas fa-undo"></i> Làm mới
            </a>
        </div>
        <div class="col-lg-6">
            <form action="{{ route('admin.product.product_category') }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="key" placeholder="Nhập tên sản phẩm..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <select class="form-select" name="categoryId">
                             <option value="">chọn danh mục </option>   
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-secondary w-25 ms-2">Lọc</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table shadow mt-2">
        <thead class="bg-info text-light">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Thuộc tính</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Danh mục</th>
                <th>Hãng xe</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)
            <tr>
                <td>
                    {{ $item->id }}
                </td>
                <td>
                    <img src="/storage/images/{{ $item->image }}" width="80" class="shadow-sm rounded" alt="" />
                    <span>{{ $item->name }}</span>
                </td>
                <td><a href="{{route('admin.attribute.add',$item->id)}}" class="btn btn-sm btn-outline-success">Thêm thuộc tính</a></td>
                <td class="text-danger fw-bold">{{ number_format($item->price) }} VND</td>
                <td>{{ $item->inStock ?? 0 }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->brand->name }}</td>
                <td>
                    <a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-sm btn-warning shadow">
                        Sửa
                    </a>
                    <a href="{{ route('admin.product.delete', $item->id) }}" class="btn btn-sm btn-danger shadow">
                        Xóa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $product->links() }}
</x-admin>