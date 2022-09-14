<?php

namespace App\Repositories\Posts;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Cache\Repository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getPostInfo(int $postId);

    public function createPost($postData);

    public function deletePost($ids);

    public function updatePost($postData,$id);

    public function index();
}