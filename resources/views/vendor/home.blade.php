@extends('vendor.dashboard')
@section('title', 'SurePay Vendor')


@section('content')
        <p>Welcome {{ session('user')[0]->userName}}!</p>
@endsection