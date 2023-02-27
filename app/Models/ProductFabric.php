<?php

namespace App\Models;

use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFabric extends Model
{
    public $timestamps = false;

    public function xztfabric () {
        return $this->belongsTo(XztFabric::class, 'fabric_id');
    }


}
