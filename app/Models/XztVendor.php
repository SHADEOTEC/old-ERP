<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XztVendor extends Model
{
    protected $table = 'xzt_vendors';

    protected $fillable = [
        'vendor',
        'formula',
        'shades',
        'fascia',
        'tube',
        'bottom_rail',
        'bottom_tube',
        'fabric_width',
        'fabric_height',
        'blind_width',
        'state',
        'archived',
    ];
}
