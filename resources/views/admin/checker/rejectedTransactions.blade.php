@extends('admin.checker.dashboard')
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
                        <th>Details</th>
                        <th>status</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach ($transactions as $transaction)
                        <tr class="{{ $transaction->transaction_id }}">
                           <td>{{ $transaction->transaction_id }}</td>
                           <td>{{ $transaction->transRef }}</td>
                           <td>{{ $transaction->transType }}</td>
                           <td>{{ $transaction->userId }}</td>
                           <td>{{ $transaction->amount }}</td>
                           <td>{{ $transaction->details }}</td>
                           <td>{{ $transaction->status }}</td>
                           <td>{{ $transaction->created_at }}</td>
                           <td>{{ $transaction->updated_at }}</td>
                           {{-- <td class="text-center d-flex justify-content-around ">
                                <button class="btn btn-success text-white" onclick="approveTransaction(this)" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></button>
                                <button class="btn btn-danger text-white" onclick="rejectTransaction(this)" data-toggle="tooltip" title="Reject"><i class="fa fa-times"></i></button>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="loader" class="bg-dark">
        <div class="container-fluid d-flex justify-content-center align-items-center bg-dark text-white" style="height: 100%">
            <p>Processing... <i class="fa fa-spinner fa-spin"></i></p>
        </div>
    </div>

    <script>
        function approveTransaction(el){
            var transactionId = $(el).parent().parent().attr('class')
            $("#loader").show("2500")
            var formdata = new FormData()
            formdata.append('_token', "{{ csrf_token() }}")
            formdata.append('transactionId', transactionId)
            $.ajax({
                type: "POST",
                url: "/admin/approveTransaction",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response)
                    location.reload()
                },
                error:function(response){
                    alert("Something went wrong, please try again later")
                }
            });
            // alert(transactionId)
        }

        function rejectTransaction(el){
            var transactionId = $(el).parent().parent().attr('class')
            $("#loader").show("2500")
            var formdata = new FormData()
            formdata.append('_token', "{{ csrf_token() }}")
            formdata.append('transactionId', transactionId)
            $.ajax({
                type: "POST",
                url: "/admin/rejectTransaction",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response)
                    location.reload()
                },
                error:function(response){
                    alert("Something went wrong, please try again later")
                }
            });
            // alert(transactionId)
        }
    </script>


    <style>
        #loader{
            position: fixed;
            z-index: 1;
            width: 100%;
            height: 100%;
            top:0;
            left: 0;
            display: none;
        }
    </style>
@endsection
