@extends('vendor.dashboard')
@section('title', 'Transactions')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <h5>Transactions: <span class="text-danger">{{ sizeof($transactions) }}</span></h5>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr class="text-center text-white bg-primary">
                        <th>transactionId</th>
                        <th>Refrence</th>
                        <th>Type</th>
                        <th>userId</th>
                        <th>Amount</th>
                        <th>credits before</th>
                        <th>credits after</th>
                        <th>Details</th>
                        <th>status</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($transactions as $transaction)
                        <tr>
                           <td>{{ $transaction->transaction_id }}</td>
                           <td>{{ $transaction->transRef }}</td>
                           <td>{{ $transaction->transType }}</td>
                           <td>{{ $transaction->userId }}</td>
                           <td>{{ $transaction->amount }}</td>
                           <td>{{ $transaction->creditsBefore }}</td>
                           <td>{{ $transaction->creditsAfter }}</td>
                           <td>{{ $transaction->details }}</td>
                           <td>{{ $transaction->status }}</td>
                           <td>{{ $transaction->created_at }}</td>
                           <td>{{ $transaction->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection