<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $post;
    private $category;
    public function __construct(Post $post,Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search !=""){
            $posts = $this->post->where('name', 'LIKE', "%$search%")->orWhere('user_name', 'LIKE', "%$search%")->paginate(10);
        }else{
            $posts = $this->post->with('categories')->orderby('id','DESC')->paginate(8);
        }
        return view('admin.posts.index',compact('posts','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('admin.posts.new',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
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
            $posts = $this->post;
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
        $posts = $this->post->find($id);
        $categories= $this->category->all();
        return view('admin.posts.edit',compact('posts','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
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
            $posts = $this->post->find($id);
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
        $posts = $this->post->find($id);
        $postName = $posts->name;
        $path = public_path('/post_images/'.$posts->avatar);

        if(File::exists($path)){
            File::delete($path);
        }
        $posts->delete();
        Session()->flash('status',$postName. 'is deleted successfully');
        return redirect('/admin/posts');
    }
}
