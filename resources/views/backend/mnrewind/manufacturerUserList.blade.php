@extends('layouts.masters.backend')
@section('content')
@section('title', 'Manufacturer Users')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <a href="{{URL::to('mnre/create-mnre-user')}}" class="btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD
                    USER
                </a> -->
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>
            <div class="col-md-12">
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                    <tr class="bg-primary text-white">
                            <th width="10%">SNo.</th>
                            <th width="35%">Name</th>
                            <th width="40%">Email</th>
                            <!-- <th width="15%">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <!-- <td> -->
                       
                         <!-- <button type="submit" class="btn btn-xs btn-danger delete-btn" data-id="{{$user->id}}" 
                         onClick="return confirm('Are you sure you want to reset password')">Reset Password</button> -->
                        <!-- <button type="button"
                                class="btn btn-xs btn-danger delete-btn"
                                data-id="{{ $user->id }}">
                            Reset Password
                        </button> -->
                  
                                <!-- <a href="{{url('mnre/edit-mnre-user/'.base64_encode($user->id))}}"
                                    class="btn btn-xs btn-primary-hallow">Reset Password</a> -->
                            <!-- </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{{ $users->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<!-- <script type="text/javascript">
    $(document).on("click",".delete-btn",function(e){

        e.preventDefault();

        let id = $(this).data('id');
        $.ajax({
          url: "{{url('mnreuser/reset-password')}}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            id:id,
          },
          success:function(response){
            console.log(response);
            if (response) {
                alert(response.success);
              //$('#success-message').text(response.success);  
            }
          },
          error: function(response) {
            alert(response.error);
            //$('#name-error').text(response.responseJSON.errors.name);
           }
         });
        });
</script> -->


<script>
$(document).on("click", ".delete-btn", function(e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to reset password?")) {
        return false;
    }

    let id = $(this).data("id");

    $.ajax({
        url: "{{ url('mnre_wind_users/reset-password') }}",
        
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },

        success: function(response) {
            console.log(response);

            alert(response.success);
        },

        error: function(xhr) {
            console.log(xhr.responseJSON);

            alert(
                xhr.responseJSON?.error ||
                xhr.responseJSON?.message ||
                "Something went wrong."
            );
        }
    });
});
</script>
@endsection