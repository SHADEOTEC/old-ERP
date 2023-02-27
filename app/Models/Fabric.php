<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Fabric extends Model
{
    protected $table = 'fabric';
    
    public function products() {
        return $this->belongsTo(Product::class);
    }
}
