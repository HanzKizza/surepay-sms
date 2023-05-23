@extends('user.dashboard')
@section('title', 'SurePay Home')
@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-4">
            <form id="customMessageGenerationForm" onsubmit="generateCustomMessages(event)">
            <!-- <form id="sendMessageForm" method="post" action="{{ route('sendMessage') }}"> -->
                <div class="card w-100">
                    <div class="card-header bg-primary text-white">
                        <h5>Customized Sms</h5>
                    </div>
                    <div class="row">
                        <div class="card-body">
                                <input type="text" name="sender" id="sender" class="form-control d-none" value="surepay"/>
                                <input type="text" name="clientId" id="clientId" class="form-control d-none" value="1"/>
                                <h6 class="mt-1 mx-2">Message</h6>
                                <textarea name="message" id="message" rows="10" class="form-control" required></textarea>
                                <h6 class="mt-3 mx-2">Upload Messsage Parameters</h6>
                                <input type="file" name="messageParameters" id="contacts" class="form-control w-100" required />
                                <div class="server-response"></div>
                        </div>
                    </div>
                    <div class="card-footer d-flex flex-row-reverse px-1" style="gap:10px">
                        <button class="btn btn-outline-success" type="button" onclick="sendMessages()" style="flex:1">Send <span class="badge totalMessages text-danger">0</span></button>
                        <button class="btn btn-outline-info" type="submit" style="flex:1">Generate</button>
                        <button class="btn btn-outline-warning" type="reset" style="flex:1">Clear</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-header bg-success text-white d-flex align-items-center flex-row-reverse">
                <input type="number" id="cliendId" value="1" class="d-none"/>
                <input type="text" id="sender" value="surepay" class="d-none"/>
                <h5 style="margin-right: 5%;">Generated SMS</h5>
                </div>
                <div class="row">
                    <div class="card-body" id="generatedMessages">
                        <table class="table table-stripped">
                            <thead>
                                <th>Number</th>
                                <th>Message</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-0 px-0">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>

    messages = ""; //this will be updated and used when finally sending messages
    function generateCustomMessages(e){
        e.preventDefault()
        $("#generatedMessages tbody").html("")
        var formdata = new FormData(document.getElementById("customMessageGenerationForm"))
        formdata.append('_token', "{{ csrf_token() }}")
        $.ajax({
            type: "POST",
            url: "/generateCustomeMessages",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                messages = JSON.parse(response)
                $(".totalMessages").text(messages.length)

                for(i = 0; i < messages.length; i++){

                    myHtml = "<tr><td>"+messages[i][0]+"</td><td>"+messages[i][1]+"</td></tr>";
                    $("#generatedMessages tbody").append(myHtml)
                    if(i == 99){
                        break;
                    }
                }
            },
            error:function(response){
                alert("Something went wrong, please try again later")
            }
        });
    }


    function sendMessages(){
        formdata = new FormData()
        clientId = $("#clientId").val()
        sender = $("#sender").val()
        formdata.append('messages', messages)
        formdata.append('sender', sender)
        formdata.append('clientId', clientId)
        formdata.append('_token', "{{ csrf_token() }}")

        if(messages == "" || messages.length == 0 || messages == null){
            alert("Cannot send empty messages")
        }
        else{
            formdata.append('messages', JSON.stringify(messages))
            formdata.append('sender', sender)
            formdata.append('clientId', clientId)
            formdata.append('_token', "{{ csrf_token() }}")
            var retryCount = 0
            $.ajax({
                type: "POST",
                url: "/sendCustomMessage",
                data: formdata,
                processData: false,
                contentType: false,
                timeout: 100000,
                success: function (response) {
                    retryCount = 0
                    alert(response)
                    location.reload()
                },
                error:function(response){
                    if (retryCount < 1) { // retry only once
                        retryCount++;
                        $.ajax(this); // retry with the same settings
                    } else {
                        alert("Something went wrong, please try again later")
                    }
                }
            });
        }
    }
</script>
