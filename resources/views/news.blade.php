<x-only-header title="Tin tức">
    <div class="row my-3">
        <div class="col-lg-9">
            <h6><a href="{{route('home')}}">Trang chủ</a> / Tin Tức</h6>
            <div class="row">
                @if ($post->count() > 0)
                @foreach ($post as $item)
                <div class="col-lg-10 mb-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ route('home.new_detail', $item->id) }}">
                                <img src="/storage/post/{{ $item->image }}"
                                    class="card-img-top shadow-sm border border-2" alt="">
                            </a>
                        </div>
                        <div class="col-lg-8">
                            <a href="{{ route('home.new_detail', $item->id) }}" class="text-dark">
                                <h6>{{ $item->title }}</h6>
                            </a>
                            <span style="font-size: 12px;"><i class="fas fa-clock"></i> {{ $item->created_at }} - {{$item->comment->count()}} bình luận</span>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-danger text-center">Chưa có bài viết</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3 d-none d-lg-block ps-5">
            <div class="row">
                <h6>TIN TỨC MỚI NHẤT</h6>
                @foreach ($post_new as $item)
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