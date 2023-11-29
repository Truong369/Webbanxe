<div class="category">
    <ul class="category_list m-0" style="list-style: none;">
        <h6 class="category_heading py-2">Danh Mục</h6>
        @foreach ($category as $item)
        <li class="category_item py-2 border-bottom">
            <a class="category_link text-decoration-none text-dark" href="{{route('home.product',$item->id)}}">{{$item->name}}</a>
        </li>
        @endforeach
    </ul>
</div>