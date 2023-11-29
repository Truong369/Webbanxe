<x-only-header title="Sản phẩm">
    <div class="row pt-3">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <x-list-category />
                </div>
                <div class="col-lg-12">

                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if (isset($product))
            <div class="row">
                @foreach ($product as $p)
                <div class="col-lg-3 col-md-4 col-6 my-2">
                    <div class="product card shadow border-0">
                        <div style="height: 140px;" class="d-flex align-items-center">
                            <a href="{{route('home.product_detail',$p->id)}}">
                                <img src="{{asset('/storage/images/'.$p->image)}}"
                                    style="object-fit: contain; width: 100%; height: 140px;" alt="">
                            </a>
                        </div>
                        <div class="card-body text-center mt-3">
                            <h6 class="card-title">{{$p->name}}</h6>
                            <span class="text-danger fw-bold">{{number_format($p->price)}} VND</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            @foreach ($category as $c)
            <div class="row">
                <span class="text-center text-light" style="background: var(--red)">{{$c->name}}</span>
                @if ($c->product->count()>0)
                @foreach ($c->product as $p)
                <div class="col-lg-3 col-md-4 col-6 my-2">
                    <div class="product card shadow border-0">
                        <div style="height: 140px;" class="d-flex align-items-center">
                            <a href="{{route('home.product_detail',$p->id)}}">
                                <img src="{{asset('/storage/images/'.$p->image)}}"
                                    style="object-fit: contain; width: 100%; height: 140px;" alt="">
                            </a>
                        </div>
                        <div class="card-body text-center mt-3">
                            <h6 class="card-title">{{$p->name}}</h6>
                            <span class="text-danger fw-bold">{{number_format($p->price)}} VND</span>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-danger text-center">Đang cập nhật...</p>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-only-header>