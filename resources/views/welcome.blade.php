<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet" />
@extends('layouts.app')

@section('content')
    {{-- タイトル --}}
    <div class="text-center">
        <div class="text-center style2 style3">
            <h1>Cafegram</h1>
        </div>
    </div>
    @if (Auth::check())
        <div class="flexbox">
            <div class="text-center">
            {{-- 投稿ページへのリンク　--}}
                <a href="{{ route('cafeposts.create')}}" class=""><button class="Button-style">+投稿する</button></a>
            {{-- マイページへのリンク --}}
                <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class=""><button class="Button-style">マイページ</button></a>
            {{-- 行きたいリストへのリンク --}}
                <a href="{{ route('users.favorites', ['id' => Auth::id()]) }}" class=""><button class="Button-style">行きたいリスト</button></a>
        
            {{-- カテゴリ検索 --}}
                <a href="{{ route('categories.search') }}" class=""><button class="Button-style"><i class="fas fa-search"></i>カテゴリ検索</button></a>
            </div>
        </div>
        
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a href="{{ route('cafeposts.index') }}" class="nav-link {{ Request::routeIs('cafeposts.index') ? 'active' : '' }}" style="color: #cd853f; background: #f5deb3">
                        タイムライン
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.popular') }}" class="nav-link {{ Request::routeIs('cafeposts.popular') ? 'active' : '' }}" style="color: #cd853f">
                        人気
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.post') }}" class="nav-link {{ Request::routeIs('cafeposts.post') ? 'active' : '' }}" style="color: #cd853f">
                        すべての投稿
                    </a>
                </li>
            </ul>
           
        <div style="margin: 40px 0;">
            @include('cafeposts.cafeposts')
        </div>
    @else
        {{-- 説明文 --}}
        <div class="text-center wf-kokoro">
            <h5>
                おしゃれな内装、かわいいスイーツ、<br>
                シックな食器にゆったりくつろぎの空間。<br>
                あなたのカフェ巡り、<br>
                ぜひみんなでシェアしませんか？<br>
            </h5>
        </div>
        <div class=" style3 flexbox">
            {{-- ユーザ登録ページへのリンク --}}
            <div style="margin-right: 15px;">
            {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-denim']) !!}
            </div>
            <div style="margin-right: 15px;">
            {{-- ログインページへのリンク --}}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-denim']) !!}</li>
            </div>
        </div>
        <div class="style4">
        {{-- おすすめ投稿一覧 --}}
        @include('cafeposts.ecafeposts')
        </div>
    @endif
@endsection