@extends('layouts.app')

@section('content')
    {{-- タブ --}}
    @include('users.navtabs')
    {{-- ユーザ一覧 --}}
    @include('users.users')
@endsection