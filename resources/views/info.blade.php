<x-only-header title="Thông tin">
    <x-category-info>
        <div class="card-body">
            <div class="row">
                <h6 class="card-header text-light bg-danger text-center py-1">Thông tin tài khoản</h6>
                <div class="col-md-4 mt-2 mb-3 text-center">
                    {{-- Avatar --}}
                    <img id="avatar_khachhang" src="/storage/avatar/{{ Auth::guard('customer')->user()->avatar }}"
                        class="rounded-circle shadow" width="150" height="150" alt="">
                    {{-- Fo1m Lưu avatar --}}
                    <form action="{{ route('home.customer.changeAvatar') }}" class="mt-3" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="upload_avatar" class="badge bg-dark fs-5" style="cursor: pointer;"><i
                                class="fas fa-camera"></i></label>
                        <p class="text-danger">
                            @error('avatar')
                                Vui lòng chọn avatar...
                            @enderror
                        </p>
                        <div class="input-group input-group-sm mt-3">
                            <input id="upload_avatar" type="file" title="Chọn avatar" class="form-control d-none"
                                name="avatar">
                        </div>
                        <button class="btn btn-sm btn-dark text-light mt-1">Cập nhật</button>
                    </form>
                </div>
                {{-- Thông tin tài khoản --}}
                <div class="col-md-8 mt-2">
                    <div class="card-body">
                        {{-- Tên --}}
                        <p>
                            <span>Họ tên: {{ Auth::guard('customer')->user()->fullName }}</span>
                        </p>
                        {{-- Email --}}
                        <p>
                            </span><span>Email: {{ Auth::guard('customer')->user()->email }}</span>
                        </p>
                        {{-- Điện thoại --}}
                        <p>
                            <span>Điện thoại: {{ Auth::guard('customer')->user()->phone }}</span>
                        </p>
                        <p>
                            <span>Trạng thái: {{ Auth::guard('customer')->user()->status == 1 ? "online" : "" }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-category-info>
    @section('script')
        <script>
            const upload_avatar = document.querySelector('#upload_avatar');
            let avatar_khachhang = document.querySelector('#avatar_khachhang');
            upload_avatar.onchange = (e) => {
                let file = e.target.files[0];
                let url = URL.createObjectURL(file);
                avatar_khachhang.setAttribute('src', url);
            }
        </script>
    @endsection
</x-only-header>
