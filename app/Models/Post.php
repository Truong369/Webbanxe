<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function author(){
        return $this->hasOne(User::class, 'id', 'id_author');
    }
    public function comment(){
        return $this->hasMany(Comment::class, 'id_post', 'id');
    }
}
