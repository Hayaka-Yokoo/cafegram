<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@extends('layouts.app')

@section('content')
    <h1>検索結果</h1>
        @if (count($cafeposts) > 0)
        <div style="margin: 40px 0;">
            <ul class="list-unstyled">
                <div class="card-columns row">
                @foreach($cafeposts as $cafepost)
                <div class="wrapper_06n">
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
        </div>
        @endif
@endsection