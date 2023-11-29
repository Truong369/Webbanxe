<x-admin title="Cap nhat thuoc tinh">
    <div class="row">
        <div class="col-6">
            <form action="{{route('admin.attribute.store_update',$product_attr->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Màu sắc</label>
                    <input type="text" class="form-control" value="{{$product_attr->color}}" name="color">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Tồn kho</label>
                    <input type="number" class="form-control" value="{{$product_attr->stock}}" name="stock">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <a href="{{route('admin.attribute.add',$product_id)}}" class="btn btn-sm btn-dark">Trở lại</a>
                <button class="btn btn-sm btn-success">Cập nhật</button>
            </form>
        </div>
    </div>
</x-admin>