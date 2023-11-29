<x-admin title="Thêm user">
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <x-input name="fullname" label="Họ tên" />
                <x-input name="email" type="email" label="Email" />
                <div class="form-group">
                    <label class="form-label">Chức vụ</label>
                    <select name="id_role" class="form-select">
                        <option value="" disabled selected>Chọn chức vụ</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('id_role')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <x-input name="password" type="password" label="Mật khẩu" />
                <x-input name="confirm_password" type="password" label="Nhập lại mật khẩu" />
            </div>
            <div class="col-lg-6">
                <x-input name="avatar" id="fileImageUser" type="file" label="Avatar" />
                <img src="" id="imageUser" width="200" alt="">
            </div>
            <div class="col-lg-12">
                <a href="{{ route('admin.user') }}" class="btn btn-sm btn-dark" id="saveBtn"><i
                        class="fas fa-arrow-left"></i> Trở lại</a>
                <button class="btn btn-sm btn-primary" id="saveBtn"><i class="fas fa-save"></i> Lưu</button>
            </div>
        </div>
    </form>
    @section('script')
        <script>
            let fileImageUser = document.getElementById('fileImageUser');
            fileImageUser.onchange = (e) => {
                let imageUser = document.getElementById('imageUser')
                url = URL.createObjectURL(fileImageUser.files[0]);
                imageUser.setAttribute('src', url)
            }
        </script>
    @stop
</x-admin>
