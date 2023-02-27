<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWand extends Model
{
    public $timestamps = false;

    public function xztwand () {
        return $this->belongsTo(XztWand::class, 'id', 'wand_id');
    }
}
