@extends('layouts.app')

@section('content')
    @include('users.navtabs')
    <div style="margin: 40px 0;">
    @include('cafeposts.cafeposts')
    </div>
@endsection