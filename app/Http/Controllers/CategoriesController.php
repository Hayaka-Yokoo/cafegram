<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cafepost;
use App\Category;
use App\CafeCategory;

class CategoriesController extends Controller
{
    public function show($categoryId)
    {
        dd(categoryId);
        // idの値でカテゴリーを検索して取得
        $category = Category::findOrFail($categoryId);
        
        // 関係するモデルの件数をロード
        $category->loadRelationshipCounts();

        $cafeposts = $category->cafeposts()->pagenate(12);
        
        // カテゴリー詳細ビューでそれを表示
        return view('categories.show', [
            'category' => $category,
            'cafeposts' => $cafeposts,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $data = $request->validate([
            'category' => 'required',
        ]);
        
        /* = [];
        foreach($data as $category) {
            $categoryId[$category] = $category;
        }*/
        
        $categoryId = $request->category;

        $cafeCategories = CafeCategory::whereIn('category_id', $categoryId)->get();
        $cafeCategoryId = [];
        foreach($cafeCategories as $cafeCategory){
            $cafeCategoryId[] = $cafeCategory->cafepost_id;
        }
        
        $id = array_unique($cafeCategoryId);
        
        $cafeposts = Cafepost::whereIn('id', $id)->get();
        $categories = Category::all();
        $disCategory = [];
        foreach($categories as $category) {
            $disCategory[$category->id] = $category;
        }
        
        $cafeCategory = CafeCategory::all();


        return view('categories.show', [
            'cafeposts' => $cafeposts,
            'categories' => $categories,
            'cafeCategory' => $cafeCategory,
            'disCategory' => $disCategory
        ]);
    }
    
    public function search()
    {
        $category = new Category;
        $categories = Category::all();

        // 検索ビューを表示
        return view('categories.search', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }
}
