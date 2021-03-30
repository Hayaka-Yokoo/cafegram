@extends('layouts.app')

@section('content')
    <div class="text-center">
        {{ $cafepost->store_name }}
    </div>
    <div class="text-center">
        <div class="card-header text-center">
            <img class="" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="" width=250px height=250px>
        </div>
    </div>
    <div class="text-center">
        <h5>営業時間   {{ $cafepost->hour }} </h5>
        <h5>住所   {{ $cafepost->address }} </h5>
        <p class="card-text"><small class="text-muted">
            @foreach($cafeCategory as $item)
                @if($item->cafepost_id == $cafepost->id)
                    #{{ $disCategory[$item->category_id]->category_name }}
                @endif
            @endforeach
        </small></p>
    </div>
@endsection
    