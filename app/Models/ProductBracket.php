<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBracket extends Model
{
    public $timestamps = false;
    
    public function xztbracket () {
        return $this->belongsTo(XztBracket::class, 'bracket_id');
    }


}
