@if(!session('user'))
    {{ redirect()->to('/user/login')->send() }}
@endif
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="shortcut icon" href="{{ asset('assets/images/surepay_logo.jpeg') }}" type="image/x-icon">
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Dashboard Nav Bar -->
                <div class="col-md-2 vh-100 px-0" id="dashboard_nav">
                    <div class="role mt-4">
                        <h4 class="text-center text-white">Vendor User</h4>
                    </div>
                    <hr style="border: dashed 1px yellow">

                    <div class="menu-items container-fluid my-2 p-0 pt-0">
                        <a class="menu-item d-flex align-items-center text-white" id="dashboard" href="/user/home">
                            <i class="fa fa-home mx-3" style="width:15px"></i>
                            <span>Dashboard</span>
                        </a>
                        <a class="menu-item d-flex align-items-center text-white" id="singlesms" href="/user/singlesms">
                            <i class="fa fa-sms mx-3" style="width:15px"></i>
                            <span>Single sms</span>
                        </a>
                        <a class="menu-item d-flex align-items-center text-white" id="bulksms" href="/user/bulksms">
                            <i class="fa fa-comments mx-3" style="width:15px"></i>
                            <span>Bulk sms</span>
                        </a>
                        <a class="menu-item d-flex align-items-center text-white" id="customsms" href="/user/customsms">
                            <i class="fa fa-chess-queen mx-3" style="width:15px"></i>
                            <span>Custom sms</span>
                        </a>
                        <a class="menu-item d-flex align-items-center text-white" id="outbox" href="/user/outbox">
                            <i class="fas fa-inbox mx-3" style="width:15px"></i>
                            <span>Outbox</span>
                        </a>
                    </div>

                    <div class="bottom col-sm-3">
                        <!-- logo -->
                        <div class="container-fluid logo p-0">
                            <img src="{{ asset('assets/images/surepay_logo.png') }}" class="img-fluid"/>
                        </div>
                    </div>
                </div>

                <!-- right-->
                <div class="col-md-10 vh-100 overflow-auto" style="background-color: #EAFDFC">
                    <!-- customer info -->
                    <div class="row top-bar">
                        <div class="container-fluid d-flex flex-row-reverse">
                            <a href="/user/signout" style="margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="Sign out">
                                <i class="fas fa-power-off text-danger" style="margin-right: 10px; padding-top: 5px"></i>
                            </a>

                            <i class="fa fa-user pt-1 text-muted"></i>
                            <h6 class="mt-1 mx-2">{{ session('user')[0]->userName }}</h6>

                            <a href="/user/topup" class="d-flex text-dark mx-2" style="text-decoration: none;">
                                <i class="fa fa-briefcase text-muted" style="padding-top: 5px"></i>
                                <h6 class="mt-1 mx-2">{{ session('user')[0]->credits }}</h6>
                            </a>

                            <h6 class="mt-1 mx-2">{{ session('user')[0]->name }}</h6>
                        </div>
                    </div>
                    <!-- Main -->
                    <div class="row mt-2" id="main">
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

<style>

</style>
