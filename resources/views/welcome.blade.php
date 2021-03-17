@extends('layouts.app')

@section('content')
    {{-- タイトル --}}
    <div class="text-center">
        <div class="text-center style2">
            <h1>Cafegram</h1>
        </div>
    </div>
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
        {-- ユーザ登録ページへのリンク --}
        {!! link_to_route('signup.get', '新規登録', [], ['class' = 'btn btn-lg btn-outline-secondary']) !!}
        <a class="btn btn-outline-secondary">ログイン</a>
    </div>
    {{-- おすすめ投稿一覧 --}}
    // 後で追記
@endsection