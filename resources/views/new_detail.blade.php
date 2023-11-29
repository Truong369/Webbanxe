<x-only-header title="{{ $post->title }}" views="{{ $post->views }}">
    <div class="row my-3">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <img src="/storage/post/{{ $post->image }}" class="w-100" alt="">
                    <p class="mt-3"><i class="far fa-calendar"></i> {{ $post->created_at->format('d/m/y H:i:s') }} bởi
                        {{ $post->author->fullname }}</p>
                    <h4 class="text-uppercase fw-bold">{{ $post->title }}</h4>
                </div>
                {{-- Bài viết --}}
                <div class="border-bottom border-1 pb-3" style="text-align: justify;">
                    {!! $post->content !!}
                </div>
            </div>
            {{-- Hiển thị comment --}}
            <div class="row mt-3">
                <h6><i class="fas fa-comment"></i> {{ $post->comment->count() }} BÌNH LUẬN:</h6>
                @foreach ($comment as $item)
                    <div class="col-lg-12 my-3 py-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <img id="avatarCustomer" src="/storage/avatar/{{ $item->customer->avatar }}"
                                class="rounded-circle shadow" width="60" height="60" alt="">
                            <div class="ms-3">
                                <h6 class="fw-bold">{{ $item->customer->fullName }}</h6>
                                <p class="text-secondary m-0">{{ $item->content }}</p>
                                <span class="text-secondary" style="font-size: 13px;">
                                    {{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @if (Auth::guard('customer')->user() && Auth::guard('customer')->user()->id == $item->customer->id)
                            <div class="text-end">
                                <a href="{{ route('home.comment.delete', $item->id) }}" class="text-danger me-5"><i
                                        class="fas fa-trash"></i></a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{-- Comment --}}
            <form action="{{ route('home.comment.store') }}" method="POST">
                @csrf
                <div class="row">
                    <h6>BÌNH LUẬN CỦA BẠN</h6>
                    <input type="hidden" name="id_post" value="{{ $post->id }}">
                    <input type="hidden" name="id_customer" value="{{ Auth::guard('customer')->user()->id ?? '' }}">
                    <div class="col-lg-12">
                        <textarea name="content" class="form-control mt-3" placeholder="Nội dung"
                            style="height: 100px; font-size: 14px; padding: 5px 20px;">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <p class="text-end">
                            <button class="mt-3 btn btn-outline-danger"><i class="fas fa-location-arrow"></i></button>
                        </p>
                    </div>
                </div>
            </form>
            {{-- End Comment --}}
        </div>
        {{-- Bài viết mới nhất --}}
        <div class="col-lg-3 d-none d-lg-block ps-5">
            <div class="row">
                <h6>TIN TỨC MỚI NHẤT</h6>
                @foreach ($posts as $item)
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ route('home.new_detail', $item->id) }}">
                                <img src="/storage/post/{{ $item->image }}" class="card-img-top shadow-sm" alt="">
                            </a>
                        </div>
                        <div class="col-lg-8">
                            <a href="{{ route('home.new_detail', $item->id) }}" class="text-dark">
                                {{ $item->title }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-only-header>
