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
            <div class="col-md-6">
                    <div class="card w-100">
                        <div class="card-header bg-primary text-white">
                            <h5>Bulk Sms</h5>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <form id="sendMessageForm" onsubmit="sendMessage(event)">
                                <!-- <form id="sendMessageForm" method="post" action="{{ route('sendMessage') }}"> -->
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
                </div>


                <div class="col-md-6">
                    <div class="card w-100">
                        <div class="card-header bg-danger text-white d-flex align-items-center">
                            <h5 style="margin-right: 30px;">Receipients</h5>
                            <input type="text" id="receipient" name="phoneNumber" class="form-control w-50 mx-2 bg-white text-success py-1" placeholder="Phone Number" />
                            <button type="submit" onclick="addToRecipient()" class="btn btn-success py-0 px-2"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="row">
                            <div class="card-body" id="receipientList" style="display:grid; grid-template-columns: auto auto auto auto;"></div>
                        </div>
                        <div class="card-footer bg-success">
                            <form method="post" enctype="multipart/form-data" class="d-flex">
                                <input type="file" name="contacts" id="contacts" class="form-control">
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </body>
</html>


<script>

    let receipients = new Array();

    function addToRecipient(){
        value = $("#receipient").val()
        $("#receipient").val('')
        if(value != ""){
            receipients.push(value)
            renderReceipient(value)
        }
    }

    function renderReceipients(){
        receipients.forEach(function(value){
            alert(value)
        })
    }

    function renderReceipient(value){
        $("#receipientList").prepend("<label class='p-1 mx-2 mt-1 px-3 bg-info text-white rounded-3 text-center'>"+value+"</label>")
    }

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