@extends('vendor.dashboard')
@section('title', 'Affiliates')


@section('content')
    <div class="container-fluid mt-4">
        <h3>Affliliates</h3>
        @if (sizeof($affiliates) == 0)
            <div class="alert alert-danger">You do not have any affiliates at the moment</div>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Vendor Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Credits</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliates as $affiliate)
                       <tr>
                            <td>{{ $affiliate->name }}</td>
                            <td>{{ $affiliate->contact }}</td>
                            <td>{{ $affiliate->email }}</td>
                            <td>{{ $affiliate->credits }}</td>
                            <td>{{ $affiliate->created_at }}</td>
                            <td>{{ $affiliate->updated_at }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn text-success px-1" onclick="creditAffiliate({{ $affiliate->vendorId }})" data-toggle="tooltip" title="credit vendor">
                                    <i class="fa fa-money-bill"></i>
                                </button>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

<script>
    function creditAffiliate(vendorId){
        var credits = prompt("Enter number of credits")
        credits =parseInt(credits)
        if(confirm("Are you sure you want to credit this vendor?") && credits > 0){
            formdata = new FormData()
            formdata.append('_token', "{{ csrf_token() }}")
            formdata.append("vendorId", vendorId)
            formdata.append("credits", credits)
            $.ajax({
                type: "POST",
                url: "/vendor/creditAffiliate",
                data: formdata,
                processData: false,
                contentType: false,
                timeout: 100000,
                success: function (response) {
                    alert(response)
                },
                error:function(response){
                        alert("Something went wrong, please try again later " +response)
                }
            });
        }
    }
</script>
