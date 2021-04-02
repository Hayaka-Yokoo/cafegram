<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cafepost_id', 'category_id'];
    
    /**
     * このカテゴリーが所有する投稿。（ Cafepostモデルとの関係を定義）
     */
    public function cafeposts(){
        return $this->belongsToMany(Cafepost::class, 'cafe_category', 'category_id', 'cafepost_id');
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['cafeposts']);
    }
    
}
