<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Category;
use App\CafeCategory;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $cafeposts = $user->cafeposts()->orderBy('created_at', 'desc')->paginate(9);

        $categories = Category::all();
        $disCategory = [];
        foreach($categories as $category) {
            $disCategory[$category->id] = $category;
        }
        
        $cafeCategory = CafeCategory::all();
        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'cafeposts' => $cafeposts,
            'categories' => $categories,
            'cafeCategory' => $cafeCategory,
            'disCategory' => $disCategory
        ]);
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    /**
     * ユーザの行きたいリスト一覧ページを表示するアクション
     */
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザの行きたいリスト一覧を取得
        $cafeposts = $user->favorites()->paginate(10);
        
        $categories = Category::all();
        $disCategory = [];
        foreach($categories as $category) {
            $disCategory[$category->id] = $category;
        }
        
        $cafeCategory = CafeCategory::all();
        
        // 行きたいリスト一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'cafeposts' => $cafeposts,
            'categories' => $categories,
            'cafeCategory' => $cafeCategory,
            'disCategory' => $disCategory
        ]);
    }
}