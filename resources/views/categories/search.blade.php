@extends('layouts.app')

@section('content')
    <h1>表示したいカテゴリを選択してください</h1>
    {!! Form::model($category, ['route' => 'categories.store', "enctype"=>"multipart/form-data"]) !!}
        {{-- カテゴリの選択 --}} 
        <div class="form-group">
            {!! Form::label('category_name', 'カテゴリー：') !!}
            @foreach ($categories as $category)
                <label>{{ Form::checkbox('category[]', $category->id) }}{{ $category->category_name }}</label>
            @endforeach
        </div>
        {!! Form::submit('検索', ['class' => 'btn btn-dark btn-block']) !!}
        {{--{!! link_to_route('categories.show', '検索', [], ['class' => 'btn btn-lg btn-secondary btn-block']) !!}--}}
    {!! Form::close() !!}
@endsection