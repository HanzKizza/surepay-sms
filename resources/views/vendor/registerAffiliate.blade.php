<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@extends('vendor.dashboard')
@section('title', 'Affiliates')


@section('content')
<div class="container mt-3">
    <div class="w-50 mt-4">
        <form id="createAffiliate" action="{{ route('createAffiliate') }}" method="post">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Register an Affiliate Vendor</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required">
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
                    </div>
                    <div class="form-group mt-2">
                        <label for="contact">Contact</label>
                        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact" required="required">
                    </div>
                    <div class="form-group mt-2 d-flex" style="gap: 20px">
                        <button type="submit" class="btn btn-success" style="flex:1">Register</button>
                        <button type="reset" class="btn btn-warning" style="flex:1">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
