<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CafeCategory extends Model
{
    protected $table = 'cafe_category';
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
