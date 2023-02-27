<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRoomtype extends Model
{
    public $timestamps = false;
    
    public function xztroomtype () {
        return $this->belongsTo(XztRoomtype::class, 'roomtype_id');
    }


}
