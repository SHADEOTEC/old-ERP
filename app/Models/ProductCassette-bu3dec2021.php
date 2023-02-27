<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCassette extends Model
{
    public $timestamps = false;
    
    public function xztcassette () {
        return $this->belongsTo(XztCassette::class, 'cassette_code', 'cassette_code');
    }


}
