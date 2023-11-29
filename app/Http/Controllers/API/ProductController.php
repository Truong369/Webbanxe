<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=1)
    {
        return Product::where('categoryId',$id)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = $this->customValidate($data);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('image');
        if ($file != null) {
            $filename = $file->hashName();
            $file->storeAs("/public/images", $filename);
            $data["image"] = $filename;
        }else{
            $data["image"] = 'product.png';
        }

        $pro = Product::create($data);

        return response()->json([
            'data' => $pro,
            'message' => 'Thêm sản phẩm thành công!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        $data = $request->all();

        $validator = $this->customValidate($data);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $file = $request->file('image');
        
        $pro = Product::find($id);

        if ($id) {
            if($file != null || $pro->image != 'default.png'){
                Storage::delete('/public/images/'.$pro->image);
            }else{
                $data['image'] = $pro->image;
            }
        }
        
        if ($file != null) {
            $filename = $file->hashName();
            $file->storeAs("/public/images", $filename);
            $data["image"] = $filename;
        }else{
            $data["image"] = 'default.png';
        }

        $pro->update($data);
        
        return response()->json([
            'data' => $pro,
            'message' => 'Cập nhật sản phẩm thành công!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Product::find($id);
        
        Product::destroy($id);
        
        Storage::delete('/public/images/' . $pro->image);

        return response()->json([
            'message' => 'Xóa sản phẩm thành công!'
        ]);
    }
    public function customValidate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'categoryId' => 'required'
        ], [], [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá',
            'description' => 'Mô tả',
            'categoryId' => 'Danh mục',
        ]);
        return $validator;
    }
}
