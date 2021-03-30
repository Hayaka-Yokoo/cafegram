<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが所有する投稿（Cafepostモデルとの関係を定義）
     */
    public function cafeposts()
    {
        return $this->hasMany(Cafepost::class);
    }
    
    /**
     * このユーザに関するモデルの件数をロードする
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['cafeposts', 'followings', 'followers', 'favorites']);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Cafepost::class, 'favorites', 'user_id', 'cafepost_id');
    }
    
    /**
      * $cafepostIdで指定された投稿を行きたいリストりに追加する。
      */
      public function favorite($cafepostId)
      {
          // すでにお気に入りに追加しているかの確認
          $exist = $this->is_favorite($cafepostId);
          
          if($exist){
              // すでに追加していれば何もしない
              return false;
          }else{
              // 未追加であれば追加する
              $this->favorites()->attach($cafepostId);
              return true;
          }
      }
      
      /**
      * $cafepostIdで指定された投稿を行きたいリストから削除する。
      */
      public function unfavorite($cafepostId)
      {
          // すでにお気に入りに追加しているかの確認
          $exist = $this->is_favorite($cafepostId);
          
          if($exist){
              // すでに追加していれば削除する
              $this->favorites()->detach($cafepostId);
              return true;
          }else{
              // 未追加であれば何もしない
              return false;
          }
      }
      
      /**
       * 指定された$cafepostIdの投稿をこのユーザがお気に入りに追加しているか調べる。
       */
       public function is_favorite($cafepostId)
       {
           // 行きたいリストに追加しているものの中に$cafepostIdのものが存在するか
           return $this->favorites()->where('cafepost_id', $cafepostId)->exists();
       }
       
    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_cafeposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Cafepost::whereIn('user_id', $userIds);
    }
}