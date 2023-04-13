@extends('user.dashboard')
@section('title', 'SurePay Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h5>Outbox: <span class="text-danger">{{ sizeof($messages) }}</span></h5>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr class="text-center text-white bg-primary">
                        <th>Telephone</th>
                        <th>Message</th>
                        <th>Time out</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($messages as $message)
                        <tr>
                            <td class="text-center">{{ $message->phoneNumber }}</td>
                            <td>{{ $message->message }}</td>
                            <td class="text-center">{{ $message->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
