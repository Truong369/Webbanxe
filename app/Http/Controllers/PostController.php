<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    function index()
    {
        $post = Post::orderBy('id', 'desc')->get();
        return view('admin.post.index', compact('post'));
    }
    function add()
    {
        return view('admin.post.add');
    }
    function edit($id)
    {
        $post = Post::find($id);
        return view('admin.post.edit',compact('post'));
    }
    function show($id=null)
    {
        $post = Post::find($id);
        return view('admin.post.show',compact('post'));
    }
    function delete($id=null)
    {
        $post = Post::find($id);
        // Nếu xóa bài viết thì xóa luôn comment
        if($post->comment->count() > 0){
            foreach($post->comment as $cmt){
                Comment::destroy($cmt->id);
            }
            Post::destroy($id);
        }else{
            Post::destroy($id);
        }
        return back();
    }
    function store(Request $request, $id=null)
    {
        $data = $request->all();
        unset($data['_token']);

        $validator = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
        ], [], [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
        ])->validate();

        $file = $request->file('image');

        if($id){
            $postOld = Post::find($id);
            if($file != null){
                Storage::delete('/public/post/'.$postOld->image);
            }else{
                $data['image'] = $postOld->image;
            }
        }

        if($file != null){
            $filename = $file->hashName();
            $file->storeAs('/public/post',$filename);
            $data['image'] = $filename;
        }else if(!$id){
            $data['image'] = 'default.jpg';
        }

        $data['id_author'] = Auth::user()->id;
        $post = Post::updateOrCreate(['id'=>$id],$data);
        $post->save();

        return redirect()->route('admin.post');
    }
}
