<x-only-header title="{{ $product->name }}">
    <div class="row my-3">
        <div class="col-lg-5 text-center border" style="padding: 40px 0;">
            <img src="/storage/images/{{ $product->image }}" id="product_image" width="80%" alt="">
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="badge bg-danger w-100">Thông tin sản phẩm</h6>
                    <ul class="m-0 p-0" style="list-style: none;">
                        <li class="my-3">
                            <h3 class="text-danger">{{ $product->name }}</h3>
                        </li>
                        <li class="my-3">
                            Giá đề xuất: <span class="h4 text-danger">{{ number_format($product->price) }} VND</span>
                        </li>
                        <li class="my-3">
                            Tình trạng: {{ $product->inStock>0 ? "Còn hàng" : "Hết hàng" }}
                        </li>
                        <li class="my-3">

                        </li>
                        <li class="my-3">
                            <form action="{{ route('home.giohang.add', $product->id) }}">
                                @csrf
                                <label class="form-label">Màu sắc:</label>
                                @if ($product->attribute->count()>0)
                                <select name="color" class="form-select" onchange="getColor()" id="select">
                                    @foreach ($product->attribute as $item)
                                    <option class="me-2" value="{{$item->image}}">
                                        {{$item->color}}
                                    </option>
                                    @endforeach
                                </select>
                                @else
                                <p>Đang cập nhật...</p>
                                @endif
                                <label for="">Số lượng:</label>
                                <input type="number" class="form-control w-100" min="1" max="10" value="1" name="quantity">
                                <button class="btn btn-sm btn-outline-danger mt-3"><i class="fas fa-shopping-cart"></i>
                                    Thêm vào
                                    giỏ
                                    hàng</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h6 class="badge bg-danger w-100">Thông số kỹ thuật</h6>
                    <ul>
                        <li class="my-3">Khối lượng bản thân: {{$product->weight}}</li>
                        <li class="my-3">Chiều cao yên: {{$product->height}}</li>
                        <li class="my-3">Dung tích bình xăng: {{$product->capacity}}</li>
                        <li class="my-3">Dung tích xy lanh: {{$product->cilinder}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-lg-12 mt-2">
            <h5 class="badge bg-secondary w-100">Mô tả sản phẩm</h5>
            <div style="text-align: justify;">{!! $product->description !!}</div>
        </div>

 
    </div>
    @section('script')
    <script>
        function getColor() {
            let select = document.querySelector("#select").value;
            let product_image = document.querySelector('#product_image');
            product_image.src = '/storage/product_attr/' + select;
        }
    </script>
    @endsection
</x-only-header>