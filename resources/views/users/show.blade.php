@extends('layouts.app')

@section('content')
    <div class="text-center style6">
        <li class="media">
            {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
            <img class="mr-2 rounded text-center" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
            <div class="media-body">
                <div class="font2" style="font-size: 40px;">
                    {{ $user->name }}
                </div>
            </div>
        </li>
    </div>
    {{-- フォロー／アンフォローボタン --}}
    <div class="style3">
        @include('user_follow.follow_btn')
    </div>
    <div>
        <ul class="nav nav-tabs nav-justified mb-3">
            {{-- ユーザ詳細タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}" style="color: #cd853f;">
                    投稿したカフェ
                    <span class="badge badge-secondary">{{ $user->cafeposts_count }}</span>
                </a>
            </li>
            {{-- フォロー一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}" style="color: #cd853f;">
                    Followings
                    <span class="badge badge-secondary">{{ $user->followings_count }}</span>
                </a>
            </li>
            {{-- フォロワー一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}" style="color: #cd853f;">
                    Followers
                    <span class="badge badge-secondary">{{ $user->followers_count }}</span>
                </a>
            </li>
            {{-- 行きたいリスト一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}" style="color: #cd853f;">
                    行きたいリスト
                    <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
                </a>
            </li>
        </ul>
        <div class="style4">
        {{-- 投稿一覧 --}}
        @include('cafeposts.cafeposts')
        </div>
    </div>
@endsection
                