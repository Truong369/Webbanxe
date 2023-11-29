<x-only-header title="Giới thiệu">
    @foreach ($about as $item)
        <h2 class="text-center py-3">{{$item->title}}</h2>
        <div style="border-bottom: 1px solid #eee;">
            {!!$item->content!!}
        </div>
    @endforeach
</x-only-header>
