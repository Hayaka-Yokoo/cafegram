@extends('layouts.app')

@section('content')

    <h1>投稿編集ページ</h1>
    
    {!! Form::model($cafepost, ['route' => ['cafeposts.update', $cafepost->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="waku02">
                    <img class="card-img-top2" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                {!! Form::label('store_name', '店名:') !!}
                {!! Form::text('store_name', old('store_name'), ['class' => 'form-control']) !!}
            </div>
            
            
            
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
            
            {!! Form::submit('更新', ['class' => 'btn btn-dark btn-block']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection