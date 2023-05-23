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

    </head>
    <body>
        <div id="main-container">
            <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
                <div class="card w-25">
                    <div class="card-header">
                        <h4 class="text-center">SurePay SMS Platform</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/vendor/verifyVendor">
                            @csrf
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="you@example.com" class="form-control my-1" required/>
                            <label for="email">Password</label>
                            <input type="password" name="password" id="password" placeholder="your secret" class="form-control my-1" required/>
                            @if($error == true)
                                <h5 class="text-danger my-3">Incorrect username or password</h5>
                            @endif
                            <div class="d-flex my-4" style="gap:20px">
                                <button type="btn" class="btn btn-outline-success w-50 py-1">Login</button>
                                <button type="reset" class="btn btn-outline-danger w-50 py-1">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <label>Vendor user? Login</label> <a href="/user/login">here.</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    #main-container{
       position:fixed;
       height: 100% !important;
       width: 100% !important;
       top: 0px;
       overflow-y: auto;
       background-size: 100% 100%;
       background-repeat: no-repeat;
       /* opacity: 0.1; */
       font-family: Georgia, 'Times New Roman', Times, serif;
       background-image: url({{ asset('assets/images/bg.jpeg') }});
   }

   @media only screen and (max-width: 600px) {
       .card{
           width: 100% !important;
       }
   }
</style>
