@extends('layouts.app')

@section('content')
    {{-- タイトル --}}
    <div class="text-center">
        <div class="text-center style2">
            <h1>Cafegram</h1>
        </div>
    </div>
    @if (Auth::check())
        <div class="text-center">
            {{-- 投稿ページへのリンク　--}}
                {!! link_to_route('cafeposts.create', '＋投稿する', [], ['class' => 'btn btn-secondary']) !!}
            {{-- マイページへのリンク --}}
                {!! link_to_route('users.show', 'マイページ', ['user' => Auth::id()], ['class' => 'btn btn-secondary']) !!}
            {{-- 行きたいリストへのリンク --}}
                {!! link_to_route('users.favorites', '行きたいリスト', ['id' => Auth::id()], ['class' => 'btn btn-secondary']) !!}
        
            {{-- カテゴリ検索 --}}
                {!! link_to_route('categories.search', 'カテゴリ検索', [], ['class' => 'btn btn-secondary']) !!}
        </div>
        <div class="row">
            <ul class="nav nav-tabs nav-justified mb-3">
                {{-- 人気投稿一覧タブ --}}
                <li class="flex-sm-fill nav-item">
                    <a href="{{ route('cafeposts.index', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('cafepsots.index') ? 'active' : '' }}">
                        人気
                    </a>
                </li>
                {{-- おすすめ投稿タブ --}}
                <li class="flex-sm-fill nav-item">
                    <a href="{{ route('cafeposts.index', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('cafepsots.index') ? 'active' : '' }}">
                        タイムライン
                    </a>
                </li>
                    
        </div>
    @else
        {{-- 説明文 --}}
        <div class="text-center">
            <h5>
                おしゃれな内装、かわいいスイーツ、<br>
                シックな食器にゆったりくつろぎの空間。<br>
                あなたのカフェ巡り、<br>
                ぜひみんなでシェアしませんか？<br>
            </h5>
        </div>
        <div class="text-center">
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-outline-secondary']) !!}
            {{-- ログインページへのリンク --}}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-outline-secondary']) !!}</li>
        </div>
    @endif
    {{-- おすすめ投稿一覧 --}}
    @include('cafeposts.ecafeposts')
@endsection