@extends('user.dashboard')
@section('title', 'SurePay Home')
@section('content')
    <div class="container-fluid">
        <div class="card w-50">
            <div class="card-header bg-primary text-white">
                <h5>Send single sms</h5>
            </div>
            <div class="card-body">
                <h6>Receipient</h6>
                <form id="sendMessageForm" onsubmit="sendMessage(event)">
                <!-- <form id="sendMessageForm" method="post" action="{{ route('sendMessage') }}"> -->
                    
                    <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control" />
                    <input type="text" name="sender" id="sender" class="form-control d-none" value="surepay"/>
                    <input type="text" name="clientId" id="clientId" class="form-control d-none" value="1"/>
                    <h6 class="mt-3">Message</h6>
                    <textarea name="message" id="message" rows="10" class="form-control"></textarea>
                    <div class="server-response"></div>
                    <div class="d-flex flex-row-reverse my-3">
                        <button class="btn btn-outline-success w-25" type="submit">Send</button>
                        <button class="btn btn-outline-danger w-25 mx-3" type="reset">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script>
    function sendMessage(e){
        e.preventDefault()
        var formdata = new FormData(document.getElementById("sendMessageForm"))
        formdata.append('_token', "{{ csrf_token() }}")
        $("#sendMessageForm .server-response").html('<i class="fa fa-spinner fa-spin" style="font-size: 25px; margin-right:9px"></i> <b>loading...</b>');
        $.ajax({
            type: "POST",
            url: "/sendMessage",
            data: formdata,
            processData: false,
            contentType: false,
            //headers: {'X-CSFR-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                $("#sendMessageForm .server-response").html(response);
            },
            error:function(response){
                // alert(JSON.stringify(response))
                // $("#sendMessageForm .server-response").html(response.text);
                alert("Something went wrong, please try again later")
            }
        });
    }
</script>