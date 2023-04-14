@extends('vendor.dashboard')
@section('title', 'SurePay Vendor')


@section('content')
        <p>Welcome {{ session('vendor')[0]->name}}!</p>
@endsection