<?php

namespace App\Models;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class XztFabric extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, "shade_cat", "id");
    }
    public function sub_category()
    {
        return $this->belongsTo(Category::class, "shade_subcat", "id");
    }
}