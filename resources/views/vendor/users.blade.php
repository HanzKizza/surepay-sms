@extends('vendor.dashboard')
@section('title', 'Users')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <h5>Users: <span class="text-danger">{{ sizeof($users) }}</span></h5>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr class="text-center text-white bg-primary">
                        <th>userId</th>
                        <th>userName</th>
                        <th>contact</th>
                        <th>email</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->userId }}</td>
                            <td>{{ $user->userName }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection