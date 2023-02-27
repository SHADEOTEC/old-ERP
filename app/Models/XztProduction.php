<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XztProduction extends Model
{
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function xztcarts()
    {
        return $this->hasMany(Xztcart::class, 'id', 'order_id');
    }
    public function order_item()
    {
        return $this->hasOne(Xztcart::class, 'id', 'order_item_id');
    }

}