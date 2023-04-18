@extends('vendor.dashboard')
@section('title', 'SurePay Vendor')


@section('content')
        <div class="container my-4">
                <div class="row d-flex flex-row mx-1" style="gap:20px">
                        <div class="my-card mx-3" style="flex:1; height:150px">
                                <h5 class="text-dark mt-3 text-decoration-underline">System Users</h5>
                                <h1 class=" text-primary mt-2">6</h1>
                                <h6 class="text-muted mt-3">All active</h6>
                        </div>
                        <div class="my-card" style="flex:1; height:150px">
                                <h5 class="text-dark mt-3 text-decoration-underline">Message Count</h5>
                                <h1 class=" text-success mt-2">100045</h1>
                                <h6 class="text-muted mt-3">Lost 7 days</h6>
                        </div>
                        <div class="my-card" style="flex:1; height:150px"></div>
                        <div class="my-card" style="flex:1; height:150px"></div>
                </div>
                <div class="row mx-2 my-4">
                        <h3>Sms for last last</h3>
                </div>
        </div>
@endsection

<style>
    .my-card{
        border-radius: 2px;
        box-shadow: 1px 1px 2px 2px grey;
    }
</style>