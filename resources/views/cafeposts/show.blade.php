<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="img01 waku02">
                <img class="" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="" width=300px height=300px>
            </div>
        </aside>
        <div class="col-sm-8">
            <h2>{{ $cafepost->store_name }}</h2>
            <h5><i class="far fa-clock"></i>営業時間</h5>
            <p>  {{ $cafepost->hour }} </p>
            <h5><i class="fas fa-map-marker-alt"></i>住所</h5>
            <p>{{ $cafepost->address }}</p>
            <h5><i class="far fa-comment"></i>コメント</h5>
            <p>{{ $cafepost->comment }}</p>
            <p class="card-text"><small class="text-muted">
                @foreach($cafeCategory as $item)
                    @if($item->cafepost_id == $cafepost->id)
                        #{{ $disCategory[$item->category_id]->category_name }}
                    @endif
                @endforeach
            </small></p>
        </div>
    </div>
@endsection