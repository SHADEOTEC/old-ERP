<?php

namespace App\Models;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class XztCassette extends Model
{
    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
