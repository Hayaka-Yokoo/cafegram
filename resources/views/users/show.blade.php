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
    <div>
        <ul class="nav nav-tabs nav-justified mb-3">
            {{-- ユーザ詳細タブ --}}
            <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                投稿したカフェ
                <span class="badge badge-secondary">{{ $user->cafeposts_count }}</span>
            </a>
            {{-- フォロー一覧タブ --}}
            <li class="nav-item"><a href="#" class="nav-link">Followings</a></li>
            {{-- フォロワー一覧タブ --}}
            <li class="nav-item"><a href="#" class="nav-link">Followers</a></li>
            {{-- フォロワー一覧タブ --}}
            <li class="nav-item"><a href="#" class="nav-link">行きたいリスト</a></li>
        </ul>
    </div>
@endsection
                