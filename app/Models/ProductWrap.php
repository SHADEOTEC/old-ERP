<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWrap extends Model
{
    public $timestamps = false;

    public function xztwrap () {
        return $this->belongsTo(XztWrap::class, 'wrap_code', 'wrap_code');
    }
}
