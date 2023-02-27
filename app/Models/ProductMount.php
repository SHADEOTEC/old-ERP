<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMount extends Model
{
    public $timestamps = false;

    public function xztmount () {
        return $this->belongsTo(XztMount::class, 'mount_id');
    }


}
