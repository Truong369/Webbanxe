<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    function index()
    {
        $about = About::all();
        return view('admin.about.index', compact('about'));
    }
    function add()
    {
        return view('admin.about.add');
    }
    function edit($id = null)
    {
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
    }
    function delete($id = null)
    {
        $about = About::find($id)->delete();
        return back();
    }
    function store(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);

        Validator::make($data, ['title' => 'required', 'content' => 'required'], [], ['title' => 'Tiêu đề', 'content' => 'Nội dung'])->validate();

        $about = About::updateOrCreate(['id' => $id], $data);

        if ($id) {
            toast()->success('Cập nhật thành công!');
        } else {
            toast()->success('Thêm thành công!');
        }

        $about->save();
        return redirect()->route('admin.about');
    }
}
