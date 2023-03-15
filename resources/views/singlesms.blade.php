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
    </body>
</html>


<script>
    function sendMessage(e){
        e.preventDefault()
        var formdata = new FormData(document.getElementById("sendMessageForm"))
        formdata.append('_token', "{{ csrf_token() }}")
        $("#sendMessageForm .server-response").html('<i class="fa fa-spinner fa-spin" style="font-size: 25px; margin-right:9px"></i> <b>loading...</b>');
        $.ajax({
            type: "POST",
            url: "/uploadFromCsv",
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