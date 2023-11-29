<x-admin title="Thêm khách hàng">
    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <x-input name="fullName" label="Họ tên" />
                <x-input name="email" type="email" label="Email" />
                <x-input name="phone" type="text" label="Số điện thoại" />
                <x-input name="password" type="password" label="Mật khẩu" />
                <x-input name="confirm_password" type="password" label="Nhập lại mật khẩu" />
            </div>
            <div class="col-lg-6">
                <x-input name="avatar" id="fileImageCustomer" type="file" label="Avatar" />
                <img src="" id="imageCustomer" width="200" alt="">
            </div>
            <div class="col-lg-12">
                <a href="{{ route('admin.customer') }}" class="btn btn-sm btn-dark" id="saveBtn"><i
                        class="fas fa-arrow-left"></i> Trở lại</a>
                <button class="btn btn-sm btn-primary" id="saveBtn"><i class="fas fa-save"></i> Lưu</button>
            </div>
        </div>
    </form>
    @section('script')
        <script>
            let fileImageCustomer = document.getElementById('fileImageCustomer');
            fileImageCustomer.onchange = (e) => {
                let imageCustomer = document.getElementById('imageCustomer')
                url = URL.createObjectURL(fileImageCustomer.files[0]);
                imageCustomer.setAttribute('src', url)
            }
        </script>
    @stop
</x-admin>
