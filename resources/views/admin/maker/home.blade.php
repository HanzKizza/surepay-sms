@extends('admin.maker.dashboard')
@section('title', 'SurePay Admin')


@section('content')
        <p>Welcome {{ session('admin')[0]->name}}!</p>
        <h1>Maker</h1>
@endsection
