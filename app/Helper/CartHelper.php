<?php

namespace App\Helper;

class CartHelper
{
    public $items = [];
    public $total_quantity = 0;
    public $total_price = 0;

    public function  __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
        $this->total_quantity = $this->get_total_quantity();
        $this->total_price = $this->get_total_price();
    }
    public function add($product, $quantity = 1, $color)
    {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'color'=>$color,
            'quantity' => $quantity ?? 1,
        ];
        // nếu trong đơn hàng đã có sản phẩm
        if (isset($this->items[$product->id])) {
            // tăng số lượng
            $this->items[$product->id]['quantity'] += $quantity;
        } else {
            $this->items[$product->id] = $item;
        }

        session(['cart' => $this->items]);
    }
    public function update($id, $quantity)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
        }
        session(['cart' => $this->items]);
    }
    public function remove($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
        session(['cart' => $this->items]);
    }
    public function clearAll()
    {
        session(['cart' => []]);
    }
    public function get_total_price()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item['price'] * $item['quantity'];
        }
        return $sum;
    }
    public function get_total_quantity()
    {
        $sum = count($this->items);
        return $sum;
    }
}
