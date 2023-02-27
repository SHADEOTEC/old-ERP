<?php

namespace App\Models;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Xztcart extends Model
{
    protected $table = 'xztcarts';
    public $timestamps = false;
    protected $guarded = [];

    public function xztshippingaddr() {
        return $this->hasOne(XztShippingAddr::class, 'id', 'shipping_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id')->with(['category']);
    }

    public function orders()
    {
        return $this->hasOne(Order::class);
    }


}
