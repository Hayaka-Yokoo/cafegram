<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafepost extends Model
{
    protected $fillable = ['store_name', 'category_name', 'img', 'title', 'address', 'hour', 'comment'];
    /**
     * この投稿を所有するユーザ（Userモデルとの関係を定義)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿のカテゴリー（Cafepostモデルとの関係を定義）
     */
    public function categories()
    {
        return $this->belongsToMany(Cafepost::class, 'cafe_category', cafepost_id, category_id);
    }
    /**
     * カテゴリーに属する投稿（Cafepostモデルとの関係を定義）
     */
    public function cafeposts()
    {
        return $this->belongsToMany(Cafepost::class, 'cafe_category', category_id, cafepost_id);
    }
    
}
