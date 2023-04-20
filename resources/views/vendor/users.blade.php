<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@extends('vendor.dashboard')
@section('title', 'Users')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h5>Users: <span class="text-danger">{{ sizeof($users) }}</span></h5>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr class="text-center text-white bg-primary">
                        <th>userId</th>
                        <th>userName</th>
                        <th>contact</th>
                        <th>email</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                        <tr style="cursor:pointer" id="{{ $user->userId }}" onclick="managerUser(this)">
                            <td>{{ $user->userId }}</td>
                            <td>{{ $user->userName }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="manageUser">
            <div class="container .d-flex flex-row-reverse">
                <button class="btn text-danger close-btn" style="float:right" onclick="$('#manageUser').hide(100)"><i class="fa fa-times" style="font-size:20px"></i></button>
            </div>
            <div class="container content"></div>
        </div>
    </div>
@endsection


<script>
    function managerUser(el){
        userId = $(el).attr("id")
        token = "{{ csrf_token() }}"
        var formdata = new FormData;
        formdata.append("userId", userId)
        formdata.append('_token', "{{ csrf_token() }}")
        $.ajax({
            type: "POST",
            url: "/vendor/manageUser",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                // alert(response)
                $("#manageUser").show()
                $("#manageUser .content").html(response)
            },
            error:function(response){
                alert("Something went wrong, please try again later")
            }
        });
    }
</script>

<style>
    #manageUser{
        position:fixed;
        display: none;
        background-color: white;
        z-index:5;
        top:9%;
        width:70%;
        height: 90%;
        border-radius: 10px;
        box-shadow: 1px 1px 2px 2px grey;
        overflow-y: auto;
    }
    #managerUser .close-btn:hover{
        background-color: red !important;
        color: white !important;
    }
</style>