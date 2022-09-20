<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function index()
    {
        $comments = $this->comment->orderBy('id','desc')->paginate(10);
        return view('admin.comments.index',compact('comments'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->comment->find($id)->delete();
        Session()->flash('status', 'is deleted successfully');
        return redirect('/admin/comments');
    }

    public function soft_trash(Request $request)
    {
        $comments = $this->comment->onlyTrashed()->orderBy('deleted_at','desc')->paginate(10);
        return view('admin.comments.soft-trash',compact('comments'));
    }

    public function untrash($id){
        $comments = $this->comment->withTrashed()->find($id);
        $comments->restore();
        Session()->flash('status', 'restore success.');
        return redirect()->back();
    }
}
