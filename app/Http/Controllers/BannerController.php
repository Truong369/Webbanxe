<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    function index($id = null){
        $banners = Banner::orderByDesc('id')->paginate(2);
        $banner = null;
        if($id){
            $banner = Banner::find($id);
        }
        return view('admin.banner.index',compact(['banners','banner']));
    }
    function edit($id=null){
        $banner = Banner::find($id);
        return view('admin.banner.edit',compact('banner'));
    }
    function store(Request $request,$id=null){
        $data = $request->all();
        unset($data['_token']);
        
        $validator = Validator::make($data,[
            'title'=>'required',
            'description'=>'required',
            'image'=>$id ? '' : 'required'
        ],[],[
            'title'=>'Tiêu đề',
            'description'=>'Mô tả',
            'image'=>'Hình ảnh'
        ])->validate();

        $file = $request->file('image');
        if($file){
            $filename = $file->hashName();
            $file->storeAs('/public/banner',$filename);
            $data['image'] = $filename;
        }

        if($id){
            $action = 'Cập nhật banner thành công!';
        }else{
            $action = 'Thêm banner thành công!';
        }

        $banner = Banner::updateOrCreate(['id'=>$id],$data);
        $banner->save();

        toast()->success($action);

        return redirect()->route('admin.banner');
    }
    function delete($id){
        Banner::destroy($id);
        return back();
    }
}
