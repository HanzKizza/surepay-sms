@extends('admin.dashboard')
@section('title', 'SurePay Admin')


@section('content')
        <p>Welcome {{ session('admin')[0]->name}}!</p>
@endsection