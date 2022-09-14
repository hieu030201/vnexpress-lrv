<?php

namespace App\Services\Posts;

interface PostServiceInterface
{
    public function getPostInfo(int $postId);

    public function deletePost($ids);

    public function createPost($postData);

    public function updatePost($postData,$id);

    public function index();
}