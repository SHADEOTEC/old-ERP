<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpringassist extends Model
{
    public $timestamps = false;

    
    public function xztspringassist () {
        return $this->belongsTo(XztSpringassist::class, 'springassist_id');
    }



}
