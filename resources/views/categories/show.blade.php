@extends('layouts.app')

@section('content')
    {{--<h1>#{{ $category->category_name }}</h1>--}}
    {{--<div>
        <p>{{ $category->cafeposts_count }}件が見つかりました。</p>
    </div>--}}
     
    <div>
        @foreach($cafeposts as $cafepost)
            <div class="card text-center border-dark mb-3" style="width: 18rem;">
                <div class="card-header bg-transparent border-dark">
                    {{ $cafepost->store_name }}
                    {{-- お気に入り追加ボタンのフォーム --}}
                    @include('favorite.favorite_button')
                </div>
                <img class="card-img-top" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $cafepost->title }}</h5>
                    <p class="card-text">{{ $cafepost->comment }}</p>
                    <p class="card-text"><small class="text-muted">
                        @foreach($cafeCategory as $item)
                            @if($item->cafepost_id == $cafepost->id)
                                #{{ $disCategory[$item->category_id]->category_name }}
                            @endif
                        @endforeach
                    </small></p>
                    {{-- カフェ詳細ページへ --}}
                    <a href="{{ route('cafeposts.show', ['cafepost' => $cafepost->id]) }}" class="nav-link {{ Request::routeIs('cafeposts.show') ? 'active' : '' }}">
                        もっと見る
                    </a>
                    <div>
                        @if (Auth::id() == $cafepost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['cafeposts.destroy', $cafepost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection