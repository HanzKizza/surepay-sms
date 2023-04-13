@extends('admin.dashboard')
@section('title', 'SurePay: Vendors')
@section('content')
    <div class="container-fluid">
        <h1>Vendors</h1>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center text-white bg-info">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th style="width:fit-content;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                    <tr id="{{ $vendor->vendorId }}">
                        <td class="name">{{ $vendor->name }}</td>
                        <td class="email">{{ $vendor->email }}</td>
                        <td class="credits">{{ $vendor->credits }}</td>
                        <td class="status">{{ $vendor->status }}</td>
                        <td class="text-center d-flex justify-content-around ">
                            <button class="btn text-success p-0" onclick="showCreditForm(this)" data-toggle="tooltip" data-placement="top" title="Topup credits"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn text-warning p-0" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-edit"></i></button>
                            <button class="btn text-danger p-0" data-toggle="tooltip" data-placement="top" title="deactivate"><i class="fa fa-trash"></i></button>
                            <button class="btn text-primary p-0" data-toggle="tooltip" data-placement="top" title="vendor users"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        
        <div id="vendorCredit" class="container-fluid">
            <div class="d-flex flex-row-reverse"><button class="btn text-danger mt-1" onclick="$('#vendorCredit').hide()"><i class="fa fa-times"></i></button></div>
            <div class="container">
                <h4 class="text-center text-primary">Vendor Credit Topup</h4>
                <hr style="border: solid blue 1px;" class="my-3">
                <div class="alert alert-info">
                    <p>Please note: To top up vendor credit, first verify the payment and ensure you have transaction details on you</p>
                </div>
                <form method="post" onsubmit="processCreditTopup(event)" id="vendorCreditForm">
                    <div class="d-flex" style="gap:10px">
                        <div class="option">
                            <label for="vendorId" class="mt-3">Vendor Id</label>
                            <input type="text" name="vendorId" id="vendorId" class="form-control mt-1" readonly required/>
                        </div>

                        <div class="option">
                            <label for="transType" class="mt-3">Vendor Name</label>
                            <input type="text" name="vendorName" id="vendorName" class="form-control mt-1" readonly required/>
                        </div>
                    </div>
                    <div class="d-flex" style="gap:10px">
                        <div class="option">
                            <label for="transRef" class="mt-3">Transaction Reference</label>
                            <input type="text" name="transRef" id="transRef" class="form-control mt-1" required/>
                        </div>

                        <div class="option">
                            <label for="transType" class="mt-3">Transaction Type</label>
                            <select name="transType" id="transType" class="form-control mt-1" required>
                                <option value="creditTopout">Credit Topup</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="gap:10px">
                        <div class="option">
                            <label for="creditsBefore" class="mt-3">Credits Before</label>
                            <input type="text" name="creditsBefore" id="creditsBefore" class="form-control mt-1" readonly required/>
                        </div>
                        <div class="option">
                            <label for="amount" class="mt-3">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control mt-1" required/>
                        </div>
                    </div>
                    <label for="Details" class="mt-3">Details</label>
                    <textarea name="details" id="details"  rows="3" class="form-control mt-1" placeholder="tranaction details" required></textarea>
                    <div class="server-response mt-3"></div>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-success w-25">Submit</button>
                        <button type="reset" class="btn btn-warning w-25 mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<style>
    #vendorCredit{
        background-color: white;
        width: 75%;
        position: absolute;
        top: 1%;
        height: 99%;
        box-shadow: 1px 2px 3px 0px black;
        border-radius: 10px;
        overflow-y: auto;
        display: none;
    }
    .option{
        flex:1;
    }
</style>

<script>
    function showCreditForm(el){
        var vendorId = $(el).parent().parent().attr("id")
        var vendorName = $("#"+vendorId+" .name").text()
        var email = $("#"+vendorId+" .email").text()
        var credits = $("#"+vendorId+" .credits").text()

        $("#vendorCredit #vendorId").val(vendorId)
        $("#vendorCredit #vendorName").val(vendorName)
        $("#vendorCredit #creditsBefore").val(credits)
        $("#vendorCredit").toggle()
    }


    function processCreditTopup(e){
        e.preventDefault()
        var formdata = new FormData(document.getElementById("vendorCreditForm"))
        formdata.append('_token', "{{ csrf_token() }}")
        $("#vendorCreditForm .server-response").html("<i class='fa fa-spinner text-info'> processing.. please wait</i>")
        $.ajax({
                type: "POST",
                url: "/admin/vendorCreditTopup",
                data: formdata,
                processData: false,
                contentType: false,
                timeout: 100000,
                success: function (response) {
                    $("#vendorCreditForm .server-response").html(response)
                    // location.reload()
                },
                error:function(response){
                    $("#vendorCreditForm .server-response").html("<i class='text-danger'> something went wrong</i>")
                }
            });
    }
</script>