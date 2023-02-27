<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductStack extends Model
{
    public $timestamps = false;
    
    public function xztstack () {
        return $this->belongsTo(XztStack::class, 'stack_id');
    }

}
