<x-admin title="Thêm bài viết">
    <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-lg-7">
                <x-input name="title" label="Tiêu đề" />
                <x-textarea name="description" label="Mô tả"></x-textarea>
                <div class="form-group mt-3">
                    <label for="editor" class="form-label">Nội dung</label>
                    <textarea name="content" id="editor"></textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <x-input name="image" id="fileImagePost" type="file" label="Hình ảnh" />
                <img src="" id="imagePost" class="w-100" alt="">
            </div>
            <div class="col-lg-12 mt-3">
                <a href="{{ route('admin.post') }}" class="btn btn-sm btn-dark" id="saveBtn"><i
                        class="fas fa-arrow-left"></i> Trở lại</a>
                <button class="btn btn-sm btn-primary" id="saveBtn"><i class="fas fa-save"></i> Lưu</button>
            </div>
        </div>
    </form>
    @section('script')
        <script>
            let fileImagePost = document.getElementById('fileImagePost');
            fileImagePost.onchange = (e) => {
                let imagePost = document.getElementById('imagePost')
                url = URL.createObjectURL(fileImagePost.files[0]);
                imagePost.setAttribute('src', url)
            }
            CKEDITOR.replace('editor');
        </script>
    @stop
</x-admin>
