<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    function index(){
        $comment = Comment::orderByDesc('id')->get();
        return view('admin.comment.index',compact('comment'));
    }
    function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $validator = Validator::make($data, [
            'content' => 'required',
        ], [], [
            'content' => 'Nội dung',
        ])->validate();

        $comment = Comment::updateOrCreate($data);
        $comment->id_post = $data['id_post'];
        $comment->id_customer = $data['id_customer'];
        $comment->save();        
        return back();
    }
    function delete($id){
        Comment::destroy($id);
        return back();
    }
}
