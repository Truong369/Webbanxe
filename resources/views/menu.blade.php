<x-only-header title="Thực đơn">
    <div class="row">
        @if ($category->count() > 0)
            @foreach ($category as $item)
                @if ($item->product->count() > 0)
                    <h2 class="text-uppercase text-center fw-bold">{{ $item->name }}</h2>
                    @foreach ($item->product as $pd)
                        <li class="col-lg-3 col-md-4 col-6 body__menu-list-item">
                            <a href="{{ route('home.product_detail', $pd->id) }}" class="body__menu-list-link text-dark ">
                                <div class="body__menu-list-link-img-btn m-auto">
                                    <img src="/storage/images/{{ $pd->image }}" alt="" />
                                    <a id="btn_add_cart" class="btn w-100 mt-3 fs-4"
                                        style="background: #4797b1; color: white;"
                                        href="{{ route('home.giohang.add', $pd->id) }}">
                                        Thêm vào giỏ hàng
                                    </a>
                                </div>
                                <p class="body__menu-list-link-desc">{{ $pd->name }}</p>
                                <p class="body__menu-list-link-price">
                                    Giá:
                                    @if ($pd->discountPrice)
                                        <span>{{ number_format($pd->price - ($pd->price * $pd->discountPrice) / 100) }}đ</span>
                                        <span
                                            style="text-decoration: line-through;">{{ number_format($pd->price) }}đ</span>
                                    @else
                                        <span> {{ number_format($pd->price) }}đ </span>
                                    @endif
                                </p>
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach
        @else
            <p class="text-danger text-center">Chưa có bài viết</p>
        @endif
    </div>
</x-only-header>
