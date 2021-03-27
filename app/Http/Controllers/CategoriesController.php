<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request){
        $cafepost = new Cafepost();
        
        $inputs = $request->validate([
            'category_id' => 'required',
        ]);
        
        $categoryId = $inputs['category_id'];
        
        $categoryData = $cafepost->categories()->sync($categoryId, false);
        
        return back();
    }
}
