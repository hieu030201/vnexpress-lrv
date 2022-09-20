<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontSearchController extends Controller
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function search_post(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = $this->post->where('name', 'LIKE' ,"%{$query}%")->orWhere('short_des', 'LIKE', "%{$query}%")->get();
            foreach($data as $row){
            $output = '
            <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">';
               
                $output .= ' <div class="post-thumbnail">
                <a href="/detail/'.$row->id.'" data-id="'.$row->id.'"><img src="'.url('/post_images/'.$row->image).'" alt=""></a>
                </div>
                <!-- Post Content -->
                <div class="post-content">
                    <a href="/detail/'.$row->id.'" data-id="'.$row->id.'" class="headline">
                        <h5 class="mb-0">'.$row->name.'</h5>
                    </a>
                </div>';
               
            $output .='</div>';
            }
            return $output;
        }
    }
}
