<x-admin title="Cập nhật sản phẩm">
    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <x-input name="name" value="{{$product->name}}" label="Tên sản phẩm" />
                <div class="form-group mt-3">
                    <label for="editor" class="form-label">Mô tả @error('description')<span class="text-danger">*</span>@enderror</label>
                    <textarea name="description" id="editor">{{$product->description}}</textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <a href="{{ route('admin.product') }}" class="btn btn-secondary mt-3"><i
                        class="fas fa-chevron-circle-left"></i> Trở lại</a>
                <button class="btn btn-success mt-3">Lưu dữ liệu</button>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Danh mục @error('categoryId')<span
                                    class="text-danger">*</span>@enderror</label>
                            <select class="form-select" name="categoryId">
                                <option value="" selected disabled>Chọn 1 danh mục</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{$product->categoryId == $item->id ? "selected" : ""}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hãng xe @error('id_brand')<span
                                    class="text-danger">*</span>@enderror</label>
                            <select class="form-select" name="id_brand">
                                <option value="" selected disabled>Chọn 1 hãng xe</option>
                                @foreach ($brand as $item)
                                <option value="{{ $item->id }}" {{$product->id_brand == $item->id ? "selected" : ""}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('id_brand')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <h6 class="text-center text-secondary">Thông số kỹ thuật</h6>
                        <x-input name="weight" value="{{$product->weight}}" label="Cân nặng" />
                        <x-input name="height" value="{{$product->height}}" label="Chiều cao" />
                        <x-input name="capacity" value="{{$product->capacity}}" label="Dung tích bình xăng" />
                        <x-input name="cilinder" value="{{$product->cilinder}}" label="Dung tích xy lanh" />
                    </div>
                    <div class="col-lg-6">
                        <x-input name="price" value="{{$product->price}}" type="number" label="Giá" />
                        <x-input name="discountPrice" value="{{$product->discountPrice}}" type="number" label="Giảm giá (%)" />
                        <x-input name="inStock" value="{{$product->inStock}}" type="number" label="Số lượng" />
                        <x-input name="image" id="fileImageProduct" type="file" label="Hình ảnh" />
                        <img src="" id="imageProduct" width="100" alt="">
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
    @section('script')
    <script>
        CKEDITOR.replace('editor');

            let fileImageProduct = document.getElementById('fileImageProduct');
            fileImageProduct.onchange = (e) => {
                let imageProduct = document.getElementById('imageProduct')
                url = URL.createObjectURL(fileImageProduct.files[0]);
                imageProduct.setAttribute('src', url)
            }
    </script>
    @endsection
</x-admin>