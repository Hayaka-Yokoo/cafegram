@extends('layouts.app')

@section('content')
    <li class="media">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
        <div class="media-body">
            <div>
                {{ $user->name }}
            </div>
        </div>
    </li>
    {{-- フォロー／アンフォローボタン --}}
    @include('user_follow.follow_button')
    <div>
        <ul class="nav nav-tabs nav-justified mb-3">
            {{-- ユーザ詳細タブ --}}
            <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                投稿したカフェ
                <span class="badge badge-secondary">{{ $user->cafeposts_count }}</span>
            </a>
            {{-- フォロー一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
                    Followings
                    <span class="badge badge-secondary">{{ $user->followings_count }}</span>
                </a>
            </li>
            {{-- フォロワー一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
                    Followers
                    <span class="badge badge-secondary">{{ $user->followers_count }}</span>
                </a>
            </li>
            {{-- 行きたいリスト一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
                    行きたいリスト
                    <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
                </a>
            </li>
        </ul>
        {{-- 投稿一覧 --}}
        @include('cafeposts.cafeposts')
    </div>
@endsection
                