<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'id_customer');
    }
    public function order_status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'id_status');
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    }

}
