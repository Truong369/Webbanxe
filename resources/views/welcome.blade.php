<x-home title="Trang chủ">
    @if ($top_products->count() > 0)
        @foreach ($top_products as $item)
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <div class="product card shadow border-0">
                    <div style="height: 140px;" class="d-flex align-items-center">
                        <a href="{{ route('home.product_detail', $item->id) }}">
                            <img src="{{ asset('/storage/images/' . $item->image) }}"
                                style="object-fit: contain; width: 100%; height: 140px;" alt="">
                        </a>
                    </div>
                    <div class="card-body text-center mt-3">
                        <a href="{{ route('home.product_detail', $item->id) }}" class="text-dark">
                            <h6 class="card-title">{{ $item->name }}</h6>
                        </a>
                        <span class="text-danger fw-bold"> {{ number_format($item->price) }} VND</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-danger">Đang cập nhật...</p>
    @endif
    <div class="col-lg-12">
        <h6 class="content_heading py-2 bg-light">
            SẢN PHẨM MỚI NHẤT</h6>
    </div>
    @if ($new_product->count() > 0)
        @foreach ($new_product as $item)
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <div class="product card shadow border-0">
                    <div style="height: 140px;" class="d-flex align-items-center">
                        <a href="{{ route('home.product_detail', $item->id) }}">
                            <img src="{{ asset('/storage/images/' . $item->image) }}"
                                style="object-fit: contain; width: 100%; height: 140px;" alt="">
                        </a>
                    </div>
                    <div class="card-body text-center mt-3">
                        <a href="{{ route('home.product_detail', $item->id) }}" class="text-dark">
                            <h6 class="card-title">{{ $item->name }}</h6>
                        </a>
                        <span class="text-danger fw-bold">{{ number_format($item->price) }} VND</span> <br>
                        <span class="text-danger fw-bold">{{ $item->cilinder }} </span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-danger">Đang cập nhật...</p>
    @endif
</x-home>
