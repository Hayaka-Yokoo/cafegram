<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * ユーザーが特定の投稿内容を行きたいリストに追加するアクション
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、idの投稿を行きたいリストに追加する
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    /**
     * ユーザが行きたいリストから削除するアクション
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、idの投稿を行きたいリストから削除する
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
