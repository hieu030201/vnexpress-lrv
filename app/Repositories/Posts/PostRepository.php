<?php

namespace App\Repositories\Posts;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    public function getPostInfo(int $postId)
    {
        return $this->find($postId);
    }

    public function createPost($postData)
    {
        $imageName="noimage.png";
        //if a user upload image
        if($postData->image){
            $postData->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$postData->image->extension();
            $postData->image->move(public_path('post_images'),$imageName);
        }
        $createPost = $this->create($postData);
        $user = Auth::user();
        $post = new Post();
        $post->user_id = $user->id;
        $post->user_name = $user->name;
        $post->name = $postData['name'];
        $post->short_des = $postData['short_des'];
        $post->category_id = $postData['category_id'];
        $post->description = $postData['description'];
        $post->image = $imageName;
        $post->save();
        Session()->flash('status',$postData->name. 'is saved successfully');
        if(!($createPost)){
            return null;
        }
    }

    public function deletePost($ids)
    {
        $post = $this->find($ids);
        $post->delete();
        return $post;
    }

    public function updatePost($postData, $id)
    {
        if($postData->image){
            $postData->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$postData->image->extension();
            $postData->image->move(public_path('post_images'),$imageName);
        }
        $user = Auth::user();
        $post = $this->find($id);
        $post->user_id = $user->id;
        $post->user_name = $user->name;
        $post->name = $postData['name'];
        $post->short_des = $postData['short_des'];
        $post->category_id = $postData['category_id'];
        $post->description = $postData['description'];
        $post->image = $imageName;
        $post->update();
        session()->flash('status',$$postData->name. 'is saved successfully');
        return $post;
    }

    public function index()
    {
        return Post::orderBy('id','DESC')->paginate(8);
    }

}