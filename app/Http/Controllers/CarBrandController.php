<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    function index($id = null){
        $brand = CarBrand::all();
        if($id){
            $update_brand = CarBrand::findOrFail($id);
            return view('admin.brand.index',compact('brand','update_brand'));
        }
        return view('admin.brand.index',compact('brand'));
    }
    function add(){
        return view('admin.brand.add');
    }
    function store(Request $request, $id=null){
        $data = $request->all();
        unset($data['_token']);
        $this->customValidator(
            $data,
            [
                'name'=>'required',
                'image'=>'required',
            ],
            [
                'name'=>'Tên hãng',
                'image'=>'Hình ảnh'
            ]
        );
        
        $file = $request->file('image');
        if ($file) {
            $filename = $file->hashName();
            $file->storeAs("/public/brand", $filename);
            $data['image'] = $filename;
        }

        CarBrand::updateOrCreate(['id'=>$id],$data);

        return redirect()->back();
    }
    function delete($id = null){
        CarBrand::destroy($id);
        return back();
    }
}
