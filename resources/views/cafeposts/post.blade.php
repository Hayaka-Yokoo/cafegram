<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@extends('layouts.app')

@section('content')
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
                    <a href="{{ route('cafeposts.index') }}" class="nav-link {{ Request::routeIs('cafeposts.index') ? 'active' : '' }}" style="color: #cd853f;">
                        タイムライン
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.popular') }}" class="nav-link {{ Request::routeIs('cafeposts.popular') ? 'active' : '' }}" style="color: #cd853f;">
                        人気
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.post') }}" class="nav-link {{ Request::routeIs('cafeposts.post') ? 'active' : '' }}" style="color: #cd853f; background: #f5deb3;">
                        すべての投稿
                    </a>
                </li>
            </ul>
    @endif
    <div style="margin: 40px 0;">
        @if (count($cafeposts) > 0)
            <ul class="list-unstyled">
                <div class="card-columns row">
                @foreach($cafeposts as $cafepost)
                <div class=" wrapper_06n">
                    <div class="card card_06" style="width: 300px;">
                        <div class="frame">
                            <span class="masking-tape"></span>
                            <img class="card-img-top" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="">
                        </div>
                        <div class="card-body">
                            <p class="card-title_06">{{ $cafepost->store_name }}</p>
                            <h5 class="card-title">{{ $cafepost->title }}</h5>
                            <p class="card-text">{{ $cafepost->comment }}</p>
                            <p class="card-text"><small class="text-muted">
                                @foreach($cafeCategory as $item)
                                    @if($item->cafepost_id == $cafepost->id)
                                        #{{ $disCategory[$item->category_id]->category_name }}
                                    @endif
                                @endforeach
                            </small></p>
                            <div class="d-flex flex-row">
                                <a href="{{ route('cafeposts.show', ['cafepost' => $cafepost->id]) }}" class="nav-link {{ Request::routeIs('cafeposts.show') ? 'active' : '' }} ">
                                    <a1>more</a1>
                                </a>
                                <div class="d-flex flex-row style5">
                                    {{-- お気に入り追加ボタンのフォーム --}}
                                    @include('favorite.favorite_button')
                                    @if (Auth::id() == $cafepost->user_id)
                                    {{-- メッセージ編集ページへのリンク --}}
                                        <a href="{{ route('cafeposts.edit', ['cafepost' => $cafepost->id]) }}" class="btn"><i class="fas fa-edit"></i></a>
                                    {{-- 投稿削除ボタンのフォーム --}}
                                        {!! Form::open(['route' => ['cafeposts.destroy', $cafepost->id], 'method' => 'delete']) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class' => "btn", 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </ul>
            {{-- ページネーションのリンク --}}
            {{ $cafeposts->links() }}
        @endif
    </div>
@endsection