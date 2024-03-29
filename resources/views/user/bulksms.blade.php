@extends('user.dashboard')
@section('title', 'SurePay Home')
@section('content')
    <div class="container-fluid mt-4">
            <div class="row">
            <div class="col-md-6">
                <div class="card w-100">
                    <div class="card-header bg-primary text-white">
                        <h5>Bulk Sms</h5>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <form id="sendMessageForm" onsubmit="sendBulkMessage(event)">
                            <!-- <form id="sendMessageForm" method="post" action="{{ route('sendMessage') }}"> -->
                                <input type="text" name="sender" id="sender" class="form-control d-none" value="surepay"/>
                                <input type="text" name="clientId" id="clientId" class="form-control d-none" value="1"/>
                                <h6 class="mt-3">Message</h6>
                                <textarea name="message" id="message" rows="10" class="form-control" required></textarea>
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
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <h5 style="margin-right: 30px;">Receipients</h5>
                        <input type="tel" id="receipient" name="phoneNumber" class="form-control w-50 mx-2 bg-white text-success py-1" placeholder="Phone Number" />
                        <button type="submit" onclick="addToRecipient()" class="btn btn-primary py-2 rounded-circle text-center px-2"><i class="fa fa-plus"></i></button>
                        <div class="totalReceipients bg-dark text-center rounded-2 px-2" style="position:absolute; height: 20p; min-width:20px; right: 2%">4</div>
                    </div>
                    <div class="row">
                        <div class="card-body" id="receipientList" style="display:grid; grid-template-columns: auto auto auto; max-height: 550px; overflow:auto"></div>
                    </div>
                    <div class="card-footer py-0 px-0">
                        <form id="contactsUploadForm" method="post" enctype="multipart/form-data" class="d-flex" onsubmit="uploadContacts(event)">
                            <input type="file" onchange="uploadContacts2(this)" name="bulkContacts" id="contacts" class="form-control w-75" style="width: 99% !important;" required />
                            <button type="reset" onclick="clearContacts()" class="btn btn-outline-danger py-0 px-2" >Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var contacts = new Array()
    var errorContacts = new Array()

    $(document).ready(function(){
        $(".totalReceipients").text(contacts.length)
    })


    function addToRecipient(){
        value = $("#receipient").val()
        $("#receipient").val('')
        if(value != ""){
            contacts.push(value)
            $(".totalReceipients").text(contacts.length)
            $("#receipientList").prepend("<label class='p-1 mx-2 mt-1 px-1 bg-info text-white rounded-3 text-center'>"+value+"</label>")
        }
    }


    function renderReceipient(){
        $(".totalReceipients").text(contacts.length)
        for(i = 0; i < 100; i++){
            if(i < contacts.length){
                $("#receipientList").prepend("<label class='p-1 mx-2 mt-1 px-3 bg-info text-white rounded-3 text-center'>"+contacts[i]+"</label>")
            }else{
                break
            }
        }
        if(errorContacts.length > 1){
            alert("The contacts "+JSON.stringify(errorContacts)+" Do not match the acceptible phonenumber pattern")
        }
    }


    function sendBulkMessage(e){
        e.preventDefault()
        message = $("#message").val()
        sender = $("#sender").val()
        clientId = $("#clientId").val()
        phoneNumbers = JSON.stringify(contacts)

        if(contacts.length == 0){
            alert("No Receipients Found")
        }

        else{
            $("#sendMessageForm .server-response").html('<i class="fa fa-spinner fa-spin" style="font-size: 25px; margin-right:9px"></i> <b>loading...</b>');
            formdata = new FormData()
            formdata.append('_token', "{{ csrf_token() }}")
            formdata.append('message', message)
            formdata.append('sender', sender)
            formdata.append('clientId', clientId)
            formdata.append('phoneNumbers', phoneNumbers)
            var retryCount = 0
            $.ajax({
                type: "POST",
                url: "/sendBulkMessage",
                data: formdata,
                processData: false,
                contentType: false,
                timeout: 100000,
                success: function (response) {
                    retryCount = 0;
                    $("#sendMessageForm .server-response").html(response);
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


    function uploadContacts2(el){
        clearContacts()
        fileInput = el
        const file = fileInput.files[0]

        Papa.parse(file, {
            header: false,
            dynmicTyping: true,
            worker: true,
            step: function(results){
                 extractContacts(results.data)
            },
            complete: function(){
                renderReceipient()
                console.log('Finished parsing file')
            },
            error: function(){
                console.error('Error parsing file')
            }
        })
    }


    function extractContacts(data) {
        var phoneNumberRegex = /^256\d{9}$/
        for (let i = 0; i < data.length; i++) {
             var phoneNumber = data[i];
            if (phoneNumber && phoneNumber.match(phoneNumberRegex)) {
                contacts.push(phoneNumber);
            }
            else{
                errorContacts.push(phoneNumber);
            }
        }
    }


    function clearContacts(){
        contacts = []
        errorContacts = []
        $("#receipientList").html("")
        renderReceipient()
    }

</script>
