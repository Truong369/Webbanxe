<x-admin title="{{ $post->title }}">
    <div class="row">
        <div class="col-lg-12">
            <img src="/storage/post/{{ $post->image }}" class="w-100" alt="">
            <p class="mt-3"><i class="far fa-calendar"></i> {{ $post->created_at->format('d/m/y H:i:s') }} bởi
                {{ $post->author->name }}</p>
            <h1 class="text-uppercase fw-bold">{{ $post->title }}</h1>
        </div>
    </div>
    {{-- Bài viết --}}
    <div class="border-bottom border-1">
        {!! $post->content !!}
    </div>
</x-admin>
