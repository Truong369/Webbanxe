<x-admin title="Thêm sản phẩm">
    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <x-input name="name" label="Tên sản phẩm" />
                <div class="form-group mt-3">
                    <label for="editor" class="form-label">Mô tả @error('description')<span class="text-danger">*</span>@enderror</label>
                    <textarea name="description" id="editor"></textarea>
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
                            <label class="form-label">Danh mục @error('categoryId')<span class="text-danger">*</span>@enderror</label>
                            <select class="form-select" name="categoryId">
                                <option value="" selected disabled>Chọn 1 danh mục</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hãng xe @error('id_brand')<span class="text-danger">*</span>@enderror</label>
                            <select class="form-select" name="id_brand">
                                <option value="" selected disabled>Chọn 1 hãng xe</option>
                                @foreach ($brand as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('id_brand')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <x-input name="weight" placeholder="VD: 100kg" label="Cân nặng" />
                        <x-input name="height" placeholder="VD: 1000mm" label="Chiều cao" />
                        <x-input name="capacity" placeholder="VD: 4,5 lít" label="Dung tích bình xăng" />
                        <x-input name="cilinder" placeholder="VD: 109cc" label="Dung tích xy lanh" />
                    </div>
                    <div class="col-lg-6">
                        <x-input name="price" type="number" label="Giá" />
                        <x-input name="inStock" type="number" label="Số lượng" />
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