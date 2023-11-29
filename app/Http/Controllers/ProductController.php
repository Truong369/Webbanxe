<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\Category;
use App\Models\Parameter;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function index()
    {
        $product = Product::orderByDesc('id')->paginate(5);
        $category = Category::all();
        return view('admin.product.index', compact(['product', 'category']));
    }
    function add()
    {
        $category = Category::all();
        $brand = CarBrand::all();
        return view('admin.product.add', compact('category', 'brand'));
    }
    function edit($id = null)
    {
        $product = Product::find($id);
        $category = Category::all();
        $brand = CarBrand::all();
        return view('admin.product.edit', compact(['product', 'category', 'brand']));
    }
    function delete($id = null)
    {
        $product = Product::find($id);
        if (empty($product->order_detail)) {
            Product::destroy($id);
            toast()->success('Xóa sản phẩm thành công!');
        } else {
            toast()->error('Xóa sản phẩm không thành công!');
        }
        return back();
    }
    function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $this->customValidator($data, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'categoryId' => 'required',
            'id_brand' => 'required',
            'inStock' => 'required',
        ], [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá',
            'description' => 'Mô tả',
            'categoryId' => 'Danh mục',
            'id_brand' => 'Hãng xe',
            'inStock' => 'Số lượng',
        ]);

        $file = $request->file('image');
        if ($file) {
            $filename = $file->hashName();
            $file->storeAs("/public/images", $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = "default.png";
        }

        $product = Product::create($data);
        $product->save();

        toast()->success('Thêm sản phẩm thành công!');

        return redirect()->route('admin.product');
    }
    function update(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);

        $this->customValidator($data, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'categoryId' => 'required',
            'id_brand' => 'required'
        ], [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá',
            'description' => 'Mô tả',
            'categoryId' => 'Danh mục',
            'id_brand' => 'Hãng xe',
        ]);

        $product = Product::find($id);
        $file = $request->file('image');

        if ($file) {
            $filename = $file->hashName();
            $file->storeAs("/public/images", $filename);
            $data['image'] = $filename;
            if ($product->image != 'default.png') {
                Storage::delete('/public/images/' . $product->image);
            }
        } else {
            $data['image'] = $product->image;
        }
        $product->update($data);

        toast()->success('Cập nhật sản phẩm thành công!');

        return back();
    }
    function list()
    {
        return Product::orderByDesc('id')->get();
    }
    function product_category(Request $request)
    {
        $category_id = $request->categoryId;
        $key = $request->key;

        // $validator = Validator::make($request->all(), ['categoryId' => 'required'], [], ['categoryId' => 'Danh mục']);

        // if ($validator->fails()) {
        //     toast()->warning('Vui lòng chọn tên danh mục!');
        //     return back();
        // }

        $product = null;
        $filters = [];

        if ($key) {
            $filters[] = ['name', 'like', '%' . $key . '%'];
        }
        if ($category_id) {
            $filters[] = ['categoryId', $category_id];
        }

        $product = Product::where($filters)->get();

        $category = Category::all();

        return view('admin.product.product_category', compact(['product', 'category', 'category_id']));
    }
}
