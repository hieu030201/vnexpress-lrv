<?php

namespace App\Services\Posts;

use App\Repositories\Posts\PostRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PostService implements PostServiceInterface
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPostInfo(int $postId)
    {
        return $this->postRepository->getPostInfo($postId);
    }

    public function deletePost($ids)
    {
        return $this->postRepository->deletePost($ids);
    }

    public function createPost($postData)
    {
        $validator = Validator::make($postData,[
            'name'=>'required|max:500',
            'short_des'=>'required|max:500',
            'description'=>'required',
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->postRepository->createPost($postData);
    }

    public function updatePost($postData,$id)
    {
        $validator = Validator::make($postData,[
            'name'=>'required|max:500',
            'short_des'=>'required|max:500',
            'description'=>'required',
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->postRepository->updatePost($postData,$id);
    }

    public function index()
    {
        return $this->postRepository->index();
    }
}