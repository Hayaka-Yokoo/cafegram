<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function cafeposts(){
        return $this->belongsToMany('App\Cafepost');
    }
}
