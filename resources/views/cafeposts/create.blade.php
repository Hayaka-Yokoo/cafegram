@extends('layouts.app')

@section('content')

    <h1>新規投稿</h1>
    
    {!! Form::model($cafepost, ['route' => 'cafeposts.store', "enctype"=>"multipart/form-data"]) !!}
    {{--{{Form::open(['route'=>'cafeposts.store',"enctype"=>"multipart/form-data"])}}--}}
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class='form-group'>
                    {!! Form::label('file', '画像投稿', ['class' => 'control-label']) !!}
                    {!! Form::file('file') !!}
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                {!! Form::label('store_name', '店名:') !!}
                {!! Form::text('store_name', old('store_name'), ['class' => 'form-control']) !!}
            </div>
            
            {{-- カテゴリの選択 --}} 
            <div class="form-group">
                {!! Form::label('category_name', 'カテゴリー：') !!}
                @foreach ($categories as $key => $category)
                    <label>{{ Form::checkbox('category[]', $category->id) }}{{ $category->category_name }}</label>
                @endforeach
            </div>
            {!! Form::close() !!}
            
            <div class="form-group">
                {!! Form::label('title', '写真タイトル：') !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('address', '住所：') !!}
                {!! Form::text('address', old('address'), ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('hour', '営業時間：') !!}
                {!! Form::text('hour', old('hour'), ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('comment', 'コメント：') !!}
                {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
            </div>
            
            {!! Form::submit('投稿', ['class' => 'btn btn-dark btn-block']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection