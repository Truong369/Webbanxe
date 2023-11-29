<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->hasOne(Category::class,  'id', 'categoryId');
    }
    public function brand()
    {
        return $this->hasOne(CarBrand::class,  'id', 'id_brand');
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class,  'id_product', 'id');
    }
    public function attribute()
    {
        return $this->hasMany(ProductAttributes::class,  'id_product', 'id');
    }
}
