<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $guarded = [];

    public function comment(){
        return $this->hasMany(Comment::class, 'id_customer', 'id');
    }
    public function contact(){
        return $this->hasMany(Contact::class, 'id_customer', 'id');
    }
}
