<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

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
                <!-- Dashboard Nav Bar -->
                <div class="col-md-2 vh-100 px-0" id="dashboard_nav">
                    <!-- logo -->
                    <div class="container-fluid logo p-2 bg-dark bg-opacity-25">
                        <img src="{{ asset('assets/images/surepay_logo.png') }}" class="img-fluid"/>
                    </div>

                    <div class="menu-items container-fluid my-4 p-0 pt-5">
                        <div class="menu-item d-flex align-items-center text-white" id="phonebook" onclick="populate(this)">
                            <i class="fa fa-home mx-3" style="width:15px"></i> 
                            <span>Phonebook</span>
                        </div>
                        <div class="menu-item d-flex align-items-center text-white" id="singlesms" onclick="populate(this)">
                            <i class="fa fa-sms mx-3" style="width:15px"></i> 
                            <span>Single sms</span>
                        </div>
                        <div class="menu-item d-flex align-items-center text-white" id="bulksms" onclick="populate(this)">
                            <i class="fa fa-comments mx-3" style="width:15px"></i> 
                            <span>Bulk sms</span>
                        </div>
                        <div class="menu-item d-flex align-items-center text-white" id="customsms" onclick="populate(this)">
                            <i class="fa fa-chess-queen mx-3" style="width:15px"></i> 
                            <span>Custom sms</span>
                        </div>
                        <div class="menu-item d-flex align-items-center text-white" id="outbox" onclick="outbox(1)">
                            <i class="fas fa-inbox mx-3" style="width:15px"></i> 
                            <span>Outbox</span>
                        </div>
                    </div>
                </div>

                <!-- right-->
                <div class="col-md-10 vh-100 overflow-auto">
                    <!-- customer info -->
                    <div class="row">
                        <div class="container-fluid d-flex flex-row-reverse">
                            <i class="fa fa-user pt-1 text-muted"></i>
                            <h6 class="mt-1 mx-2">{{ session('user')[0]->userName }}</h6>

                            <i class="fa fa-briefcase text-muted" style="margin-right: 10px; padding-top: 5px"></i>
                            <h6 class="mt-1 mx-2">{{ session('user')[0]->credits }}</h6>

                            <i class="fa fa-user-group text-muted" style="margin-right: 10px; padding-top: 5px"></i>
                            <h6 class="mt-1 mx-2">14</h6>

                            <h6 class="mt-1 mx-2">{{ session('user')[0]->name }}</h6>
                        </div>
                    </div>
                    <!-- Main -->
                    <div class="row" id="main">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<script>
    function populate(el){
        var page = $(el).attr("id")
        $.post("/populate", {
                '_token': "{{ csrf_token() }}",
                page: page
            },
            function(data, status) {
                if(status == 'success'){
                    $("#main").html(data)
                }
                else{
                    alert("Page not found")
                }
            }
        );
    }


    function outbox(clientId){
        $.post("/loadOutBox", {
                '_token': "{{ csrf_token() }}",
                clientId: clientId
            },
            function(data, status) {
                if(status == 'success'){
                    $("#main").html(data)
                }
                else{
                    alert("Page not found")
                }
            }
        );
    }

</script>
