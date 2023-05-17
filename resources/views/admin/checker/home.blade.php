@extends('admin.checker.dashboard')
@section('title', 'SurePay Admin')


@section('content')
        <p>Welcome {{ session('admin')[0]->name}}!</p>
        <h1>Checker</h1>
@endsection
