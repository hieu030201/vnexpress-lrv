<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function posts()
    {
        return $this->hasOne(Post::class,'id','user_id');
    }

    public function comment_child()
    {
        return $this->hasMany(Comment::class,'parent_id','id');
    }
}
