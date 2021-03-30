@if(Auth::user()->is_favorite($cafepost->id))
    {{-- 行きたいリスト削除ボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.unfavorite', $cafepost->id], 'method' => 'delete']) !!}
        {{--{!! Form::submit('Unfavorite', ['class' => "btn btn-secondary btn-sm"]) !!}--}}
        {!! Form::button('<i class="fas fa-star"></i>', ['class' => "btn", 'type' => 'submit']) !!}
    {!! Form::close() !!}
@else
    {{-- お気に入り追加ボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.favorite', $cafepost->id]]) !!}
        {{--{!! Form::submit('Favorite', ['class' => "btn btn-success btn-sm"]) !!}--}}
        {!! Form::button('<i class="far fa-star"></i>', ['class' => "btn", 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endif