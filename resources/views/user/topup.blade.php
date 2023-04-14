@extends('user.dashboard')
@section('title', 'SurePay Topup')
@section('content')
    <div class="container-fluid">
            <div class="row">
            <div class="col-md-6">
                <div class="container creditCard rounded-3 py-3 text-white">
                    <div class="row">
                        <h3>{{ session('user')[0]->name }}</h3>
                    </div>
                    <div class="row mt-3">
                        <h5 class="text-center text-muted">Current Credits:</h5>
                        <h1 class="text-center">{{ session('user')[0]->credits }}</h1>
                    </div>
                    <div class="row mt-5">
                        <h5 class="text-white">Credit rate: @ugx 40</h5>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card w-100">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h5 style="margin-right: 30px;">Auto Credit Topup</h5>
                    </div> 
                    <div class="card-body">
                        <form id="topupForm" method="post" onsubmit="initiateAutoTopup(event)">
                            <label for="phoneNumber" class="label mt-3">Phone number</label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control mt-2" placeholder="256*******" required minlength="10" pattern="256\d{9}"/>

                            <label for="amount" class="label mt-3">Amount <span class="text-muted">(UGX)</span></label>
                            <input type="number" name="amount" id="amount" class="form-control mt-2" placeholder="Amount to pay" min="500" required />

                            <label for="telecom" class="label mt-3">Telecom</label>
                            <select type="number" name="telecom" id="telecom" class="form-control mt-2" required>
                                <option value="mtn">MTN UGANDA</option>
                                <option value="airtel">AIRTEL UGANDA</option>
                            </select>

                            <div class="d-none">
                                <input type="number" name="vendorId" id="vendorId" value="{{ session('user')[0]->vendorId }}">
                                <input type="number" name="creditsBefore" id="creditsBefore" value="{{ session('user')[0]->credits }}">
                                <input type="number" name="userId" id="userID" value="{{ session('user')[0]->userId }}">
                            </div>
                            <div class="server-response"></div>
                            <div class="mt-4 d-flex" style="gap:20px">
                                <button type="submit" class="btn btn-success" style="flex: 1">Submit</button>
                                <button type="reset" class="btn btn-warning" style="flex:1">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .creditCard{
        background: rgb(240,20,16);
        background: linear-gradient(97deg, rgba(240,20,16,1) 0%, rgba(3,8,187,1) 100%);
        height: 250px;
        font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
    }
</style>

<script>
    function initiateAutoTopup(e){
        e.preventDefault()
        if(confirm("Confirm to make this credit purchase")){
            var formdata = new FormData(document.getElementById("topupForm"))
            formdata.append('_token', "{{ csrf_token() }}")
            $("#topupForm .server-response").html("<i class='fa fa-spinner text-info'> processing.. please wait</i>")
            $.ajax({
                    type: "POST",
                    url: "/user/creditTopup",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    timeout: 100000,
                    success: function (response) {
                        try {
                            var data = JSON.parse(response)
                            if(data[0]){
                                console.log(data[1])
                                $("#topupForm .server-response").html("Transaction initiated, please complete when the popup")
                            }
                        } catch (error) {
                            console.log(error)
                            $("#topupForm .server-response").html("<i class='text-danger'> something went wrong: contact surepay</i>")
                        }
                    },
                    error:function(response){
                        $("#topupForm .server-response").html("<i class='text-danger'> something went wrong</i>")
                    }
                });
        }
    }
</script>