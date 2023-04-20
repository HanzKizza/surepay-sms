<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div>
    <div class="container py-4">
        <h3 class="my-2">User details</h3>
        <span>Username</span>
        <h6 class="form-control w-25 my-2">{{ $user[0]->userName }}</h6>

        <span>Email</span>
        <h6 class="form-control w-25 my-2">{{ $user[0]->email }}</h6>

        <span>Contact</span>
        <h6 class="form-control w-25 my-2">{{ $user[0]->contact }}</h6>

        <span>Created at</span>
        <h6 class="form-control w-25 my-2">{{ $user[0]->created_at }}</h6>

        <span>Updated at</span>
        <h6 class="form-control w-25 my-2">{{ $user[0]->updated_at }}</h6>

        <span>Transactions</span>
        <h6 class="form-control w-25 my-2">{{ sizeof($transactions) }} <button class="btn" onclick="$('.user-transactions').toggle('slow')" style="float:right"><i class="fa fa-chevron-down"></i></button></h6>
        <div class="container-fluid collapse user-transactions">
            <h6 class="text-center">User Transactions</h6>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr class="text-center text-white bg-primary">
                        <th>Refrence</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>credits_before</th>
                        <th>credits_after</th>
                        <th>Details</th>
                        <th>status</th>
                        <th>created_at</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($transactions as $transaction)
                        <tr>
                           <td>{{ $transaction->transRef }}</td>
                           <td>{{ $transaction->transType }}</td>
                           <td>{{ $transaction->amount }}</td>
                           <td>{{ $transaction->creditsBefore }}</td>
                           <td>{{ $transaction->creditsAfter }}</td>
                           <td>{{ $transaction->details }}</td>
                           <td>{{ $transaction->status }}</td>
                           <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <span>Messages</span>
        <h6 class="form-control w-25 my-2">{{ sizeof($messages) }} <button class="btn" onclick="$('.user-messages').toggle('slow')" style="float:right"><i class="fa fa-chevron-down"></i></button></h6>
        <div class="container-fluid user-messages collapse">
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
</div>