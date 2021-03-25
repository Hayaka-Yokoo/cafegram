<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = config('const.category');
        
        return view('cafeposts.index', [
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        // バリデーション
        $request->validate([
            'category_name' => 'required',
        ]);
    }

    public function complete()
    {
        return view('categories.complete');
    }
}
