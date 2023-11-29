<?php

namespace App\Http\Controllers;

use App\Helper\CartHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function index()
    {
        return view('cart');
    }
    function add(CartHelper $cart, $id, Request $request)
    {
        $product = Product::find($id);
        if ($product->discountPrice) {
            $product->price -= ($product->price * $product->discountPrice / 100);
        }
        $cart->add($product, $request->quantity, $request->color);
        toast()->success('Đã thêm vào giỏ hàng!');
        return back();
    }
    function update(CartHelper $cart, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $cart->update($request['id_product'], $request['quantity']);
        toast()->success('Cập nhật số lượng thành công');
        return back();
    }
    function remove(CartHelper $cart, $id)
    {
        $cart->remove($id);
        return back();
    }
    function clearAll(CartHelper $cart)
    {
        $cart->clearAll();
        return back();
    }
}
