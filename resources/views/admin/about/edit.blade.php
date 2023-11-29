<x-admin title="Cập nhật trang giới thiệu">
    <form action="{{ route('admin.about.store',$about->id) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-lg-7">
                <x-input value="{{$about->title}}" name="title" label="Tiêu đề" />
                <div class="form-group mt-3">
                    <label for="editor" class="form-label">Nội dung</label>
                    <textarea name="content" id="editor">{{$about->content ?? ''}}</textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" id="saveBtn"><i class="fas fa-save"></i> Lưu</button>
            </div>
        </div>
    </form>
    @section('script')
        <script>
            CKEDITOR.replace('editor');
        </script>
    @stop
</x-admin>
