<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('front.index',compact('categories'));
    }
    public function getPostByCategory($category_id)
    {
        $postByCategory = Post::where('category_id',$category_id)->orderBy('id', 'DESC')->limit(6)->get();
        $html ='';
        foreach($postByCategory as $post)
        {
            $html .= '
            <a href="/detail/'.$post->id.'" data-id="'.$post->id.'">
                <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="'.url('/post_images/'.$post->image).'" alt="">
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <a href="#" class="headline">
                            <h5>'.$post->name.'</h5>
                        </a>
                        <p>'.$post->short_des.'...</p>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <p><a href="#" class="post-author">'.$post->user_name.'</a> on <a href="#" class="post-date">'.$post->created_at.'</a></p>
                        </div>
                    </div>
                </div>
            </a>
            ';
        }
        return $html;
    }

    function detail($id)
    {
        $data = Post::find($id);
        return view('front.detail',compact('data'));
    }
}
