<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cafepost_id', 'category_id'];
    
    /**
     * このユーザが所有する投稿。（ Cafepostモデルとの関係を定義）
     */
    public function cafeposts(){
        return $this->belongsToMany('App\Cafepost', 'cafe_category', 'category_id', 'category_id');
    }
    
}
