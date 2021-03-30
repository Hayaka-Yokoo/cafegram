<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Cafepost;
use App\Category;
use App\CafeCategory;
use Storage;

class CafepostsController extends Controller
{
    public function index()
    {
        $data = [];
        $user = null;
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $cafeposts = $user->feed_cafeposts()->orderBy('created_at', 'desc')->paginate(9);
        }
        
        //$cafeposts = Cafepost::paginate(9);
        $categories = Category::all();
        $disCategory = [];
        foreach($categories as $category) {
            $disCategory[$category->id] = $category;
        }
        
        $cafeCategory = CafeCategory::all();

        $data = [
                'user' => $user,
                'cafeposts' => $cafeposts,
                'categories' => $categories,
                'cafeCategory' => $cafeCategory,
                'disCategory' => $disCategory
            ];
        
        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでcafeposts/createにアクセスされた場合の「新規作成画面表示処理」
    public function create()
    {
        $cafepost = new Cafepost;
        
        $categories = Category::all();

        // 新規投稿ビューを表示
        return view('cafeposts.create', [
            'cafepost' => $cafepost,
            'categories' => $categories,
        ]);
    }
    
    // postでcafeposts/にアクセスされた場合の「新規作成処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            // 'file' => 'required|max:10240|mimes:jpeg,gif,png',
            'store_name' => 'required|max:50',
            'title' => 'required|max:50',
            'address' => 'required|max:50',
            'hour' => 'required|max:50',
            'comment' => 'required|max:255',
        ]);
        
        // 認証済みユーザの要項として作成
        $data = $request->user()->cafeposts()->create([
            'img' => $request->file,
            'store_name' => $request->store_name,
            'title' => $request->title,
            'address' => $request->address,
            'hour' => $request->hour,
            'comment' => $request->comment,
        ]);
     
        $cafepostId = $data['id'];
        $cafepost = Cafepost::find($cafepostId);
        foreach($request->category as $categoryId){
            $cafepost->categories()->attach($categoryId);
        }
       
        // s3に画像を保存
        $file = $request->file('file');
        $path = Storage::disk('s3')->put('/', $file, 'public');
        
        // カラムに画像のパスを保存
        $cafepost->update([
            'img' => $path
        ]);
        
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $cafepost = Cafepost::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $cafepost->loadRelationshipCounts();

        //$categories = $cafepost->categories()->get();
        
        $categories = Category::all();
        $disCategory = [];
        foreach($categories as $category) {
            $disCategory[$category->id] = $category;
        }
        
        $cafeCategory = CafeCategory::all();
        
        // 投稿詳細ビューでそれを表示
        return view('cafeposts.show', [
            'cafepost' => $cafepost,
            'categories' => $categories,
            'cafeCategory' => $cafeCategory,
            'disCategory' => $disCategory
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでcafeposts（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // id の値で投稿を検索して取得
        $cafepost = Cafepost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿編集ビューでそれを表示
        if (\Auth::id() === $cafepost->user_id) {
            return view('cafeposts.edit', [
                'cafepost' => $cafepost,
            ]);
        }
        
        return redirect('/');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'store_name' => 'required|max:50',
            'file' => 'required|max:10240|mimes:jpeg,gif,png',
            'title' => 'required|max:50',
            'address' => 'required|max:50',
            'hour' => 'required|max:50',
            'comment' => 'required|max:255',
        ]);
        
        // idの値で投稿を検索して取得
        $cafepost = Cafepost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合
        if (\Auth::id() === $cafepost->user_id) {
            $cafepost->store_name = $request->store_name;
            $cafepost->file = $request->file;
            $cafepost->title = $request->title;
            $cafepost->address = $request->address;
            $cafepost->hour = $request->hour;
            $cafepost->comment = $request->comment;
            $cafepost->save();
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $cafepost = \App\Cafepost::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $cafepost->user_id) {
            $cafepost->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
    }
}