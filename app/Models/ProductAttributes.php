<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product_attr(){
        return $this->hasMany(ProductAttributes::class, 'id_product', 'id');
    }
}
