@extends('user.dashboard')
@section('title', 'SurePay Home')
<script src="{{ asset('assets/js/plotly.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


@section('content')
        <div class="container my-4">
                <div class="row d-flex flex-row mx-1" style="gap:20px">
                        <div class="my-card mx-3" style="flex:1; height:150px; background-color: #6C00FF !important">
                                <h5 class="text-white mt-3 text-decoration-underline">System Users</h5>
                                <h1 class=" text-warning mt-2 d-flex align-items-center"><i class="fa fa-users text-dark" style="margin-right: 10px; font-size:18px"></i>{{ session("users")[0]->users }}</h1>
                                <h6 class="text-muted mt-3">All active</h6>
                        </div>
                        <div class="my-card" style="flex:1; height:150px; background-color: #3C79F5">
                                <h5 class="text-white mt-3 text-decoration-underline">Message Count</h5>
                                <h1 class=" text-warning mt-2 d-flex align-items-center"><i class="fa fa-comments text-dark" style="margin-right: 10px; font-size:18px"></i>{{ session("messages")[0]->messages }}</h1>
                                <h6 class="text-muted mt-3">Last 7 days</h6>
                        </div>
                        <div class="my-card" style="flex:1; height:150px; background-color: #2DCDDF">
                                <h5 class="text-dark mt-3 text-decoration-underline">Transactions</h5>
                                <h1 class=" text-danger mt-2 d-flex align-items-center"><i class="fa fa-money-bill-transfer text-dark" style="margin-right: 10px; font-size:18px"></i>{{ session("transactions")[0]->transactions }}</h1>
                                <h6 class="text-muted mt-3">Last 30 days</h6></div>
                        <div class="my-card" style="flex:1; height:150px; background-color: #F2DEBA">
                                <h5 class="text-dark mt-3 text-decoration-underline">Credits</h5>
                                <h1 class=" text-danger mt-2 d-flex align-items-center"><i class="fa fa-briefcase text-dark" style="margin-right: 10px; font-size:18px"></i>{{ session('user')[0]->credits }}</h1>
                                <h6 class="text-muted mt-3">SMS Credits</h6>
                        </div>
                </div>
                <div class="row mx-2 mt-2">
                        <div class="container" style="width: 100% !important" id="myPlot"></div>
                </div>
        </div>
@endsection

<style>
    .my-card{
        border-radius: 2px;
        /* box-shadow: 1px 1px 2px 2px grey; */
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
</style>

<script>
        $(document).ready(async function(){
                var xArray = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                //var yArray = [7,8,8,9,9,9,10,11,14,14,15,23,32,12,32,3,0, 9, 19,45,21,22,23,15,13,31,32,21,16,21];
                var yArray = await getMessagesPer30Days();
                // Define Data
                var data = [{
                x: xArray,
                y: yArray,
                mode:"lines",
                type:"scatter"
                }];


                min = Math.min(yArray)
                max = Math.max(yArray)

                // Define Layout
                var layout = {
                xaxis: {range: [0, 30], title: "Days"},
                yaxis: {range: [0, max], title: "SMS"},
                title: "Sms Last 30 days"
                };

                // Display using Plotly
                Plotly.newPlot("myPlot", data, layout);
        })


        function getMessagesPer30Days(){
                return new Promise(function(resolve, reject) {
                        var formdata = new FormData()
                        formdata.append('_token', "{{ csrf_token() }}")
                        $.ajax({
                        type: "POST",
                        url: "/vendor/messageCountByDay",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                                var arraydata = JSON.parse(response);
                                resolve(arraydata);
                        },
                        error:function(response){
                                reject("Something went wrong, please try again later");
                        }
                        });
                });
        }
</script>
