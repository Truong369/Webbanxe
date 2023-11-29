<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    function add($id = null)
    {
        $product_id = Product::find($id);
        $product_attr = ProductAttributes::where('id_product', $id)->get();
        return view('admin.attribute.add', compact('product_id', 'product_attr'));
    }
    function update($id = null)
    {
        $product_attr = ProductAttributes::findOrFail($id);
        $product_id = $product_attr->id_product;
        return view('admin.attribute.edit', compact('product_attr','product_id'));
    }
    function store_update(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);
        if ($request->image) {
            $file = $request->image;
            $filename = $file->HashName();
            $file->storeAs('/public/product_attr', $filename);
            $data['image'] = $filename;
        }
        $product_attr = ProductAttributes::findOrFail($id);
        $product_attr->update($data);
        $product_attr->save();
        return back();
    }
    function delete($id=null){
        ProductAttributes::destroy($id);
        return back();
    }
    function store(Request $request)
    {
        $data = $request->all();
        $id_product = $request->id_product;
        unset($data['_token']);

        $this->customValidator($data, [
            'color' => 'required|array|min:1',
            'stock' => 'required|array|min:1'
        ], [
            'color' => 'Màu sắc',
            'stock' => 'Tồn kho'
        ]);

        if ($data) {
            foreach ($data['color'] as $key => $value) {
                $attr = new ProductAttributes();
                $attr->color = $data['color'][$key];
                $attr->stock = $data['stock'][$key];
                $file = $data['image'][$key];
                if ($file != null) {
                    $filename = $file->hashName();
                    $file->storeAs('/public/product_attr', $filename);
                    $attr->image = $filename;
                }
                $attr->id_product = $id_product;
                $attr->save();
            }
        }

        return redirect()->back();
    }
}
