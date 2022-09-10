<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FrontCommentController extends Controller
{

    public function comment(Request $request,$post_id)
    {
        $request->validate([
            'content'=>'required|max:500',
        ]);
        $users = Auth::user();
        $data = [
            'user_id' => $users->id,
            'user_name' => $users->name,
            'content' => $request->content,
            'post_id' => $post_id,
        ];
        if($comment = Comment::create($data)){
            $comments = Comment::where(['post_id',$post_id,'parent_id'=>0])->orderBy('id','DESC')->get();
            return view('front.component.comment',compact('comments'));
        }
    }
}
