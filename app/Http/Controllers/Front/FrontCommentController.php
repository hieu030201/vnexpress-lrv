<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FrontCommentController extends Controller
{
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function comment(Request $request,$post_id)
    {
        $request->validate([
            'content'=>'required|max:500',
        ]);
        $users = Auth::user();
        $data = [
            'user_id' => $users->id,
            'user_name' => $users->name,
            'post_id'=>$post_id,
            'content' => $request->content,
            'parent_id' =>$request->parent_id ? $request->parent_id : 0,
        ];
        if($comment = Comment::create($data)){
            $comments = Comment::where(['post_id',$post_id,'parent_id'=>0])->orderBy('id','DESC')->get();
            return view('front.component.comment',compact('comments'));
        }
        echo 'Không thể bình luận';
    }

    public function destroy(Request $request)
    {
        if(Auth::check())
        {
            $comment = $this->comment->where('id',$request->comment_id)
                ->where('user_id',Auth::user()->id)
                ->first();
            if($comment)
            {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'success'=>"Xóa thành công",
                ]);
            }else{
                return response()->json([
                    'status' => 500,
                    'success'=>"Xảy ra lỗi",
                    ]);
            }
            
            
    }else{
        return response()->json([
            'status'=>401,
            'message'=>'Login to delete this comment',
        ]);
    }
    }
}
