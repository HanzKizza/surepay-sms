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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body>
        <div id="main-container">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="https://surepayltd.com/index.html"><img src="{{ asset('assets/images/surepay_logo.jpeg') }}" class="img-fluid rounded-1"/></a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                          <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="https://surepayltd.com/index.html">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="#features">Features</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="#">Pricing</a>
                          </li>
                        </ul>
                        <div class="navbar-text">
                          <a href="/user/login" class="btn btn-primary rounded-5 shadow text-white" style="width:100px">Login</a>
                          <a href="/vendor/register" class="btn btn-success rounded-5 shadow text-white" style="width:100px">Sign up</a>
                        </div>
                      </div>
                    </div>
                  </nav>
                  <section id="main-content" class="mt-5 pt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 animate__animated animate__fadeInRight animate__slow">
                                <div class="img-div px-4">
                                    <img src="{{ asset('assets/images/bulk.jpeg') }}" class="img-fluid rounded-5 shadow" style="height:400px">
                                </div>
                            </div>
                            <div class="col-md-6 py-5 animate__animated animate__fadeInLeft animate__slow">
                                <h3 class='text-white text-capitalize'>Seemlessly engage your Audience with our sms solution</h3>
                                <p class="mt-3" style="font-family: Georgia, 'Times New Roman', Times, serif">
                                    <i class="fa-solid fa-quote-left text-primary mx-3" style="font-size:300%"></i>
                                    Effortlessly connect and engage with your audience using our cutting-edge SMS software, offering bulk SMS, personalized messaging, customized branding, and reliable transactional SMS solutions. Experience seamless communication and unlock new levels of success with SurePay.</p>
                            </div>
                        </div>
                    </div>
                  </section>
                  <section id="features" class="mt-5 pt-1">
                    <div class="container">
                        <h2 class="text-center text-white mb-5">Product Features</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card bg-transparent">
                                    <div class="card-title bg-danger pt-2">
                                        <h4 class="text-center">Bulk SMS</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Effortlessly engage and reach your audience with personalized bulk SMS. Cost-effective and efficient communication.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-transparent">
                                    <div class="card-title bg-danger pt-2">
                                        <h4 class="text-center">Scheduled</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Efficiently plan and automate your messaging with scheduled SMS. Stay connected and save time.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-transparent">
                                    <div class="card-title bg-danger pt-2">
                                        <h4 class="text-center">Custom SMS</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Create personalized SMS messages by adding universal parameters (e.g., @FirstName) linked to CSV column headers for customized bulk SMS.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-transparent">
                                    <div class="card-title bg-danger pt-2">
                                        <h4 class="text-center">API Integration</h4>
                                    </div>
                                    <div class="card-body">
                                        Seamlessly integrate your custom software solutions with our SMS platform for efficient and automated message sending.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </section>
            </div>
        </div>
    </body>
</html>



<style>
    #main-container{
        position:fixed;
        height: 100%;
        width: 100% !important;
        top: 0px;
        overflow-y: auto;
        background-size:100%, 100%;
        background-repeat: no-repeat;
        /* opacity: 0.1; */
        font-family: Georgia, 'Times New Roman', Times, serif;
        background-image: url({{ asset('assets/images/bg.jpeg') }});
    }
    .navbar-brand{
        width: 15%;
    }

    .card{
        height: 200px;
    }

    /* width */
    ::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: red;
    border-radius: 10px;
    }

    .card-title{
        background-color: rgb(21, 179, 0) !important;
        color: white !important;
    }
</style>
