<x-only-header title="Tìm kiếm">
    <div class="row pt-3">
        <div class="col-lg-3">
            <x-list-category />
        </div>
        <div class="col-lg-9">
            <div class="row">
                @if ($product->count() == null)
                <p class="text-danger text-center">Không tìm thấy sản phẩm!</p>
                @else
                @foreach ($product as $item)
                <div class="col-lg-3 col-md-4 col-6 mb-2">
                    <div class="product card shadow border-0">
                        <div style="height: 140px;" class="d-flex align-items-center">
                            <a href="{{route('home.product_detail',$item->id)}}">
                                <img src="{{asset('/storage/images/'.$item->image)}}" style="object-fit: contain; width: 100%; height: 140px;" alt="">
                            </a>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a href="{{route('home.product_detail',$item->id)}}" class="text-dark">
                                <h6 class="card-title">{{$item->name}}</h6>
                            </a>
                            <span class="text-danger fw-bold">{{number_format($item->price)}} VND</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-only-header>