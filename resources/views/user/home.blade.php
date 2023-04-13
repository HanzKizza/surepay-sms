@if(!session('user'))
    {{ redirect()->to('/vendor/login')->send() }}
@endif
@extends('user.dashboard')
@section('title', 'SurePay Home')


@section('content')
        <p>Welcome {{ session('user')[0]->userName}}!</p>
@endsection