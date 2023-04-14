@extends('vendor.dashboard')
@section('title', 'Transactions')


@section('content')
    <div class="container-fluid">
        <div class="container">
            <h3 class="my-3">Create a new user</h3>
            <form action="/vendor/saveuser" method="post">
                @csrf 
                <label class="label mt-3" for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control mt-1" required />

                <label class="label mt-3" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control mt-1" required />

                <label class="label mt-3" for="contact">Contact</label>
                <input type="tel" name="contact" id="contact" class="form-control mt-1" minlength="10" pattern="256\d{9}" required />

                <div class="mt-5">
                    <button type = "submit" class="btn btn-success w-25">Submit</button>
                    <button type = "reset" class="btn btn-warning w-25 mx-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection