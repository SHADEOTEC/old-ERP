<?php

namespace App\Models;
use App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductControltype extends Model
{
    public $timestamps = false;
    
    public function manual () {
        return $this->belongsTo(XztManualCts::class, 'ct_manual_id');
    }
    public function motor () {
        return $this->belongsTo(XztMotorCts::class, 'ct_motor_id');
    }
    public function width () {
        return $this->belongsTo(XztWidMotors::class, 'ct_code');
    }

}
