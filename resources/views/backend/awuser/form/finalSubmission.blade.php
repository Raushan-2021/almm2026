@inject('general', 'App\Http\Controllers\Backend\Mfft\AwAnnexureController')
@extends('layouts.masters.backend')
@section('title', 'New Application')
@section('content')


<style>
     .comn_drop_shdow{border: 1px solid #dedede;
    background: #ffffff;
    border-radius: 0px 0px 8px 8px;
    box-shadow: 0 0 5px #dedede;}
    .table_max_height{max-height:350px; overflow:auto}
 
        .tab_desgn ul li {
            background: #f1f1f1;
            /* border-right: 1px solid #d1d1d1; */

            height: 80px;
            position: relative;
        }

        .tab_desgn ul li:last-child {
            border-right: none;
            ;
        }
    img.turbine_orange {
        height: 70px;
        position: absolute;
        top: 8px;
        right: 0;
    }
        .tab_desgn ul li a {
            /* position: relative; */
            background-color: #0d6efd00 !important;
            color: #777777 !important;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0;
            margin: 0;
            border-radius: 0 !important;

            text-align: center;
            padding: 15px 0;
            background-color: #eee;
            box-shadow: 0 0 0 1px #ddd;
            top: 15px;
            transition: top .2s;
            height: 100%;border-top: 1px solid #49be80!important;
        }

        .tab_desgn ul li a div {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding-top: 20px;
        }

        .tab_desgn ul li a.active {
            /* position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            
            color: #2754db !important;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #dedede;
             */
                
            border-radius: 0;
            border-bottom: 0;
            background-color: #f7941d !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
                
        }

        .arrow-down {
            display: none;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 22px solid #49be80;
            position: absolute;
            top: -1px;
            left: calc(50% - 20px);
        }

        .arrow-down-inner {
            display: none;
            width: 0;
            height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 12px solid #fff;
            position: absolute;
            top: -1px;
            left: 38.4%;
        }

        /* .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        } */

        /* .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        } */

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color:rgb(255, 255, 255);
        }
</style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">

<!-- <li class="nav-item ">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
        <p class="arrow-down">
            <p class="arrow-down-inner"></p>
        </p>
        <div>Electrical Data <br>4.3</div>
    </a>
</li> -->


    
<li class="nav-item">

        <a class="nav-link" href="{{ URL::to('mfft/annexure-four/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 2 .Collaboration </div>
</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
    <li class="nav-item">
	
	<a class="nav-link" href="{{ URL::to('mfft/annexure-four-two/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 3. Type Certificate Details </div>
	</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('mfft/annexure-four-three/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div>4. Manufacturing Facility</div>
	</a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
	
    <li class="nav-item">

        <a class="nav-link"  href="{{ URL::to('mfft/application-affdt-indt/' . $general->encodeid($application_id)) }}" style="    background: #009948!important; color: #ffffff !important;">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>5. Affidavit & Indemnity</div>
        </a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
   
    <li class="nav-item">
        <a class="nav-link active"  href="{{ URL::to('mfft/application-submission/' .$general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>6. Additional Information</div>
        </a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>

</ul>
</div>

<div class="row" style="padding:0 10px">
   
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="box-header with-border">
                            Final Submission
                        </div> -->
                        <div class="box-body">
                            <form action="{{URL::to('/mfft/application-submission')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <div style="" class="">
                                            <div colspan="2" class="text-left">
                                            <!-- <div  style="font-size: 18px; padding: 5px;">7.0 Additional Information  </div> -->
                                            </div>
                                        </div>


                                <table class="table table-bordered" id="show_data" style="">
                                    <tr>
                                        <th>
                                        
                                            <div class="row ">
                                            
                                                 <!-- 10.4 Declaration by Raushan -->
                                                <div style="clear:both"></div>
                                                <div class="col-md-12"><br>
                                                    <input type="checkbox" name="declaration" id="declaration"
                                                        value="1">
                                                    <i>I authorize that entered information in proposal are correct and verified( <a href="javascript:;" class="text-primary" data-bs-toggle="modal" data-bs-target="#termcondition1">Terms and Conditions</a>)<small class="text-danger"> * </small>
                                                        @error('declaration') <span class="valid_class">
                                                            {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-12"><br>
                                                <button type="submit" name="submit" class="btn btn-success" id="submit" style="display:none"> <i class='fa fa-check'></i> Final Submission</button>                                               
                                                <input type="button" name="submit" value="Final Submission" class="btn btn-success" id="confirmButton">
                                                
                                                <!-- Preview Application -->
                                                <!-- <a href="javascript:;" data-bs-toggle="modal"  data-bs-target="#previewApplication" onclick="previewApplication('{{$general->encodeid($application_id)}}')" class="btn btn-primary">Application Preview </a> -->
                                                <!-- <button type="button" data-bs-toggle="modal"  data-bs-target="#previewApplication" onclick="previewApplication('{{$general->encodeid($application_id)}}')" class="btn btn-primary">Application Preview</button> -->
                                                <a href="{{URL::to('/mfft/application-affdt-indt/' .$general->encodeid($application_id))}}"
                                                    class="btn btn-primary" style="float:right"><i class="fa fa-arrow-left"></i> Back </a>
                                                <br>
                                                <input type="hidden" name="edit_id" id="edit_id"
                                                    value="{{$general->encodeid($application_id)}}">
                                                <input type="hidden" name="application_id" id="application_id"
                                                        value="{{$general->encodeid($application_id)}}">

                                                </div>
                                            </div>
                                            
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
        <!-- /.row -->
        <div class="modal fade" id="previewApplication" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Application Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Display Application Data here -->
                        <div class="row" id="applicationPreview"> </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


<div class="modal fade" id="termcondition1" tabindex="-1" aria-labelledby="termcondition1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termcondition1Label">Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Your terms and conditions content goes here -->
        <p style="text-align: justify;">
        I do hereby declare that all information and documents are provided in complete manner. I confirm that all the information provided in the 'Application Form' and in the other documents is true, complete and correct. I agree that in the event of any particular information given being found false or incorrect or any discrepancy at any point of time, our application is liable to be rejected or cancelled or liable to be terminated and the wind turbine model shall be removed from the List, if enlisted, without any prior notice by MNRE. I unconditionally agree to comply with all the requirements, terms and conditions stipulated by MNRE.
        </p>

 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>

    <style>
    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        display: block;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    function previewApplication(id){
        $.ajax({
            url: baseUrl+"/mfft/preview-application/"+id,
            type: "GET",
            success: function(response) {
                console.log(response);
                $('#applicationPreview').html(response.result);

            },
            error: function(response) {
                //alert(response.error);
                //$('#name-error').text(response.responseJSON.errors.name);
            }
        });
    }

    $('#confirmButton').on("click", function() {
        if (confirm("After Final submission changes not allowed.Are you sure you want to perform this action?")) {
            $("#submit").click();
        } else {
            return false;
        }
    });
    </script>
    @endpush