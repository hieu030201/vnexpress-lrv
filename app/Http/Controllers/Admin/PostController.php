<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.new',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:500',
            'description'=>'required',
        ]);
        $imageName="noimage.png";
        //if a user upload image
        if($request->image){
            $request->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('post_images'),$imageName);
        }
            $users = Auth::user();
            $posts = new Post();
            $posts->user_id = $users->id;
            $posts->user_name = $users->name;
            $posts->name = $request->name;
            $posts->category_id = $request->category_id;
            $posts->image = $imageName;
            $posts->short_des = $request->short_des;
            $posts->description = $request->description;
            $posts->save();
            $request->session()->flash('status',$request->name. 'is saved successfully');
            return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        $categories= Category::all();
        return view('admin.posts.edit',compact('posts','categories'));
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
            $request->validate([
            'name'=>'required|max:500',
            'description'=>'required',
            'category_id'=>'required|numeric',
            'short_des' =>'required|max:500'
        ]);
        $imageName="noimage.png";
        //if a user upload image
        if($request->image){
            $request->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('post_images'),$imageName);
        }
            $users = Auth::user();
            $posts = Post::find($id);
            $posts->user_id = $users->id;
            $posts->user_name = $users->name;
            $posts->name = $request->name;
            $posts->category_id = $request->category_id;
            $posts->image = $imageName;
            $posts->short_des = $request->short_des;
            $posts->description = $request->description;
            $posts->save();
            $request->session()->flash('status',$request->name. 'is saved successfully');
            return redirect('/admin/posts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::find($id);
        $postName = $posts->name;
        $posts->delete();
        Session()->flash('status',$postName. 'is deleted successfully');
        return redirect('/admin/posts');
    }
}
