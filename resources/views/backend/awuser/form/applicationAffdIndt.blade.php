@inject('general', 'App\Http\Controllers\Backend\Mfft\MainController')
@extends('layouts.masters.backend')
@section('title', 'ALMM :: Affidavit Indemnity')
@section('content')
@php $docBaseUrl ='mfft/preview-docs/Annexure/';
$attchmentBaseUrl ='mfft/preview-docs/Attachment/';
@endphp
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
<li class="nav-item">

        <a class="nav-link" href="{{ URL::to('mfft/annexure-four/' . $application_id) }}" style="    background: #009948!important; color: #ffffff !important;">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 2 .Collaboration </div>
</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
    <li class="nav-item">
	
	<a class="nav-link" href="{{ URL::to('mfft/annexure-four-two/' . $application_id) }}" style="    background: #009948!important; color: #ffffff !important;">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 3. Type Certificate Details </div>
	</a>
<img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}"    >
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('mfft/annexure-four-three/' . $application_id) }}" style="    background: #009948!important; color: #ffffff !important;">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div>4. Manufacturing Facility</div>
	</a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
	
    <li class="nav-item">

        <a class="nav-link active"  href="{{ URL::to('mfft/application-affdt-indt/' . $application_id) }}" style="    background: #009948!important; color: #ffffff !important;">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>5. Affidavit & Indemnity</div>
        </a><img class="turbine_orange" src= "{{ URL::asset('frontend/images/turbine_orange.gif') }}" >
    </li>
   
    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('mfft/application-submission/' .$application_id) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>6. Additional Information</div>
        </a>
    </li>

</ul>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row" style="padding:0 10px">
 
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-body pt-4">

                        <div class="box-body">
                            <form action="{{URL::to('/mfft/application-affdt-indt')}}" method="POST"
                                enctype="multipart/form-data" id="formFileAjax">
                                @csrf
                                @method('POST')
                                <div style="" class="">
                                            <div colspan="2" class="text-left">
                                               <div  style="font-size: 18px; padding: 5px;">5. Affidavit and Indemnity </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div  class="text-left">
                                                                        a). Affidavit
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div style="clear:both"></div>
                                                            <div class="col-md-12">
                                                                <label for="">Upload Application <small class="text-primary">(File should be in PDF Format and Max. 10 MB)</small></label>
                                                                <input type="file" name="signatory_document" id="signatory_document" class="form-control pdf_file_10mb">
                                                                @error('signatory_document') <span class="valid_class"> {{ $message }} </span> @enderror
                                                            </div>

                                                            <div>
                                                                <label for=""> Affidavit Provided <span class="text-danger">*</span> </label><br>
                                                                <label>
                                                                    <input type="radio" name="affidavit" id="affidavit_yes" value="yes" {{ old('affidavit') == 'yes' ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="affidavit" id="affidavit_no" value="no" {{ old('affidavit') == 'no' ? 'checked' : '' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <table class="table table-bordered" id="show_data" style="">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <div  class="text-left">
                                                                        b). Indemnity
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                        <td>
                                                                <div style="clear:both"></div>
                                                                <div class="col-md-12">
                                                                    <label for="">Upload Application <small class="text-primary">(File should be in PDF Format and Max. 10 MB)</small></label>
                                                                    <input type="file" name="indemnity_document" id="indemnity_document" class="form-control pdf_file_10mb">
                                                                    @error('indemnity_document') <span class="valid_class"> {{ $message }} </span> @enderror
                                                                </div>
                                                                
                                                                <div>
                                                                    <label for="">Indemnity Provided  <span class="text-danger">*</span> </label><br>
                                                                    <input type="radio" name="indemnity" id="indemnity_yes" value="yes" {{ old('indemnity') == 'yes' ? 'checked' : '' }}>
                                                                    Yes
                                                                    <input type="radio" name="indemnity" id="indemnity_no" value="no" {{ old('indemnity') == 'no' ? 'checked' : '' }}>
                                                                    No
                                                                    <input type="hidden" name="edit_id" id="edit_id" value="{{ $application_id }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                </table>
                                            </div>
                                            
                                            <div class="col-xl-12">
                                                 <div class="text-end mt-2">
                                                    <button type="submit" class="btn btn-primary" >
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                   

                                
                                    @if ($records && $records->count() > 0)
                                        <h4 class="mt-1">Saved Record</h4>
                                        <table class="table table-bordered">
                                            <thead style="background: #e2f2ff;">
                                                <tr>
                                                    <th>Affidavit</th>
                                                    <th>Affidavit File</th>
                                                    <th>Indemnity</th>
                                                    <th>Indemnity File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $record)
                                                    <tr>
                                                        <td>{{ ucfirst($record->affidavit) }}</td>
                                                        <td>
                                                            @if($record['signatory_document']!='')
                                                            <a target="_blank"
                                                                href="{{URL::to($attchmentBaseUrl.$record['signatory_document'])}}"
                                                                class="document text-primary">View File</a>
                                                            @endif
                                                        </td>

                                                        <td>{{ ucfirst($record->indemnity) }}</td>
                                                        <td>
                                                            @if($record['signatory_document']!='')
                                                            <a target="_blank"
                                                                href="{{URL::to($attchmentBaseUrl.$record['indemnity_document'])}}"
                                                                class="document text-primary">View File</a>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="{{URL::to('/mfft/annexure-four-three/'.$application_id)}}"
                                            class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>
                                            Back </a>
                                    
                                    <a href="{{URL::to('/mfft/application-submission/'.$application_id)}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>

                                        
                
                                </div>
                            </div>

                            

                        </div>
                    </div>
                    

                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            
            <!-- /.row -->
        </div>
    </div>
    <style>
    .max-char {
        position: absolute;
        right: 35px;
        margin-top: -24px;
    }

    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        /* margin-top: -14px; */
        /* position: absolute; */
        display: block;
    }
    </style>
    @endsection