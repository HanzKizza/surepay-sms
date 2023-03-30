<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SurePay SMS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
        
    </head>
    <body>
        <div class="container-fluid">
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
                            <div class="card-footer d-flex flex-row-reverse px-1">
                                <button class="btn btn-outline-success" type="submit" style="width:30%;">Generate</button>
                                <button class="btn btn-outline-danger" type="reset" style="width:30%; margin-right:20px">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-md-8">
                    <div class="card w-100">
                        <div class="card-header bg-danger text-white d-flex align-items-center flex-row-reverse">
                        <button class="btn btn-outline-warning p-1 py-0" onclick="sendMessages()">Send <span class="badge totalMessages">0</span></button>   
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
    </body>
</html>


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