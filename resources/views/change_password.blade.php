<x-only-header title="Thay đổi mật khẩu">
    <x-category-info>
        <div class="w-50 m-auto py-5">
            <form action="{{route('home.storeChangePassword')}}" method="POST">
                @csrf
                <x-input type="password" class="fs-4" name="old_password" label="Mật khẩu cũ" />
                <x-input type="password" class="fs-4" name="new_password" label="Mật khẩu mới" />
                <x-input type="password" class="fs-4" name="confirm_new_password" label="Xác nhận mật khẩu" />
                <button class="mt-3 btn btn-sm fs-4 btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
            </form>
        </div>
    </x-category-info>
</x-only-header>
