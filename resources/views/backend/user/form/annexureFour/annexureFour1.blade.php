@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@extends('layouts.masters.backend')
@section('title', 'Collaboration / Design Ownership Details')
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
            background-color: #ffffff !important;
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
            border-top: 1px solid #49be80;
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

        .tab_desgn ul li a.active .arrow-down {
            display: block !important;
        }

        .tab_desgn ul li a.active .arrow-down-inner {
            display: block !important;
        }

        .tab_desgn .tab-content {
            border: 1px solid #dedede;
            border-top: none;

        }

        .tab_desgn ul li a.active div {
            color: #4d72c7;
        }
    </style>

<div class="container-fluid tab_desgn ">
<!-- Nav pills -->
<ul class="nav nav-pills nav-justified" role="tablist">
   
    <li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/module-master/'  .$general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div>Solar PV Modules <br> 3.0</div>
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/annexure-one/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br> 3.1-3.3</div>
    </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{ URL::to('users/annexure-one-b/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.4-3.5</div>
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-one-c/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> Module <br>3.6-3.10</div>
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('users/annexure-three/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 4.Bis Registration</div>
    </a>
    </li>

    <li class="nav-item">
        <a class="nav-link active" href="{{ URL::to('users/annexure-four/' . $general->encodeid($application_id)) }}">
    <p class="arrow-down">
        <p class="arrow-down-inner"></p>
    </p>
    <div> 5.Collaboration </div>
    </a>
    </li>

    <li class="nav-item">
	<a class="nav-link" href="{{ URL::to('users/annexure-four-two/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 6.Type Certificate Details </div>
	</a>
    </li>

    <li class="nav-item">
    <a class="nav-link " href="{{ URL::to('users/annexure-four-three/' . $general->encodeid($application_id)) }}">
		<p class="arrow-down">
			<p class="arrow-down-inner"></p>
		</p>
		<div> 7.Manufacturing Facility </div>
	</a>
    </li>
	
    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('users/application-fees/' . $general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>8-9. Fee</div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"  href="{{ URL::to('users/application-submission/' .$general->encodeid($application_id)) }}">
            <p class="arrow-down">
                <p class="arrow-down-inner"></p>
            </p>
            <div>10.Affidavit & Indemnity</div>
        </a>
    </li>
</ul>
</div>

<div class="row" style="padding:0 10px">
    @include('backend.user.form._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')


        <div class="comn_drop_shdow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                    <div class="box-body">
                                
                            <form action="{{ URL::to('/users/annexure-four')}}" method="POST"
                                enctype="multipart/form-data" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" 
                                    style="display:@if($annexuredata!=null) @else none @endif">

                                    <tr>
                                      <td>
                                        <table class="table table-bordered">
                                          <tr>
                                            <td colspan="4" class="bg-primary text-light">
                                                @if(($annexuredata->subAnnexureType ?? '')==701)
                                                    7.0 Manufacture Details
                                                @endif
                                            </td>
                                            </tr>
                                                <tr>
                                                    <th width="20%">Module Technology</th>
                                                    <td class="text-primary">{{ $annexuredata->module_name ?? '' }}</td>
                                                </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >
                                            <div class="row">
                                            <span id="detail_type_51"
                                                 style="display:@if(($annexuredata->subAnnexureType ?? '')==51))  @else none @endif">
                                                     <!-- 5.2  -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th style="text-align: left;">Whether Collaboration available for this Solar Photovoltaic(PV) Model Model<small class="text-danger"> * </small></th>
                                                        </tr>
                                                      
                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==51)
                                                       <?php //print_r($annexuredata); ?>
                                                        <tr>
                                                           <td>

                                                           <input type="hidden" name="edit_id1" id="edit_id1" required
                                                           value="@if(isset($edit_id)){{$edit_id}}@endif">
                                                            <div class="col-md-6">
                                                                <!-- <label for=""> Whether Collaboration available for this Solar Photovoltaic(PV) Model Model <span
                                                                        class="text-danger">*</span> </label> -->
                                                                <select name="whether_enlisted[]" id="whether_enlisted_"
                                                                    class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Yes" @if(isset($annexuredata->whether_enlisted)
                                                                        &&
                                                                        $annexuredata->whether_enlisted=="Yes")selected @endif>Yes
                                                                    </option>
                                                                    <option value="No" @if(isset($annexuredata->whether_enlisted)
                                                                        &&
                                                                        $annexuredata->whether_enlisted=="No")selected @endif>No
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            </td>
                                                        </tr>
                                                        @endif
                                
                                                    </table>
                                                </span>
                                            </div>
                                       
                                  
                                            <div class="row">
                                                <span id="detail_type_5200"
                                                  style="display:@if(($annexuredata->subAnnexureType ?? '')==5200))  @else none @endif">
                                        
                                                     <!-- 5.3  -->
                                                    <table class="table text-center">
                                                        <tr>
                                                            <th>Collaborator Details<small class="text-danger"> * </small></th>
                                                        </tr>
                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==5200)
                                
                                                            <tr>
                                                             <th>
                                                                <!-- <input type="hidden1" name="edit_id1" id="edit_id1"
                                                           value="@if(isset($edit_id)){{$edit_id}}@endif"> -->
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-4">
                                                                        <label for="">Name  <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="name_of_company[]"
                                                                            placeholder="Name " id="name_of_company_"
                                                                            class="form-control" maxlength="70"
                                                                            value="{{$annexuredata->annexure[0]['name_of_company'] ?? '' }}">
                                                                    </div>
                                                                   
                                                                    <div class="col-md-6">
                                                                        <label for="">Address <span class="text-danger">*</span> </label>
                                                                        <textarea name="coll_address[]" id="coll_address_" class="form-control" cols="10"
                                                                            rows="2"
                                                                            placeholder="Complete Address of Brand/Company name">{{ $annexuredata->annexure[0]['coll_address'] ?? '' }}</textarea>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <label for="">Country <span class="text-danger">*</span></label>
                                                                        <select name="country" id="country" class="form-control">
                                                                        <option value="">Select</option>
                                                                        @foreach($countrydata as $country)
                                                                        <option value="{{$country->countrycd}}"
                                                                            @if(isset($annexuredata->country) &&
                                                                            $annexuredata->country==$country->countrycd)selected
                                                                            @endif>{{$country->name}}</option>
                                                                        @endforeach
                                                                      </select>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <strong><label for="phone">Phone <small
                                                                            class="text-danger">*</small></label></strong>
                                                                            <input type="number" name="collab_phone[]" id="collab_phone_" oninput="javascript: if (this.value.length > 
                                                                            this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" 
                                                                                pattern="[0-9]{1,10}" 
                                                                            placeholder="Contact/Phone Number" 
                                                                                class="form-control"
                                                                                value="{{ $annexuredata->annexure[0]['collab_phone'] ?? '' }}" >
                                                                        </div>

                                                                        <div class="col-md-4"><strong><label for="email">Email id <small
                                                                        class="text-danger">*</small></label><strong>
                                                                            <input type="email" name="collab_email[]" id="collab_email_"
                                                                                class="form-control" placeholder="Email Address"
                                                                                value="{{ $annexuredata->annexure[0]['collab_email'] ?? '' }}">
                                                                        </div>
                                                                </div>
                                                             </th>
                                                            </tr>
                                                            @endif
                                                    </table>
                                                </span>
                                            </div>
                                               
                                            <div class="row">
                                               <?php //echo $subAnnexureType;?>
                                                <span id="detail_type_53" style="display:@if(($annexuredata->subAnnexureType ?? '')==53))  @else none @endif">
                                                     <!-- 5.4  -->   
                                                    <table class="table text-center">
                                                        <tr>
                                                
                                                            <th>5.4 Indian Territory Jurisdiction of Collaboration and period of Collaboration <small class="text-danger"> * </small></th>
                                                            
                                                        </tr>
                                                       
                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==53)
                                                        <tr>
                                                           <td>

                                                                    <div class="col-md-6">
                                                                    <label for="ind_territory">5.4 Indian Territory Jurisdiction of Collaboration and period of Collaboration <span class="text-danger">*</span></label>
                                                                    <select class="form-control" id="ind_territory_" name="ind_territory[]" onchange="toggleAdditionalFields(this)">
                                                                        <option value="">Select</option>
                                                                        <option value="no" @if(isset($annexuredata->ind_territory) && $annexuredata->ind_territory=="Yes")selected @endif>No</option>
                                                                        <option value="yes" @if(isset($annexuredata->ind_territory) && $annexuredata->ind_territory=="No")selected @endif>Yes</option>
                                                                    </select>
                                                                    
                                                                    <div id="additionalFields" style="display: none;">
                                                                        <!-- Additional fields will be shown here -->
                                                                        <!-- <label for="period">Period:</label>
                                                                        <input type="text" class="form-control" id="period_" placeholder="Enter No. of Months" name="period[]"> -->

                                                                        <label for="from_ind">From:</label>
                                                                        <input type="date" class="form-control" id="from_ind_" name="from_ind[]">

                                                                        <label for="to_ind">To:</label>
                                                                        <input type="date" class="form-control" id="to_ind_" name="to_ind[]">
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        @endif
                                
                                                    </table>
                                                </span>
                                            </div>
                                      
                                            <div class="row">
                                                <span id="detail_type_54" style="display:@if(($annexuredata->subAnnexureType ?? '')==54))  @else none @endif">
                                                     <!-- 5.4  -->
                                                    <table class="table text-center">
                                                        <tr>
                                                
                                                            <th>Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company<small class="text-danger"> * </small></th>
                                                            
                                                        </tr>
                                                        @if(!Empty($annexuredata) && $annexuredata->subAnnexureType==54)
                                                       
                                                        <tr>
                                                           <td>

                                                           <!-- <input type="hidden1" name="edit_id1" id="edit_id1"
                                                           value="@if(isset($edit_id)){{$edit_id}}@endif"> -->
                                                            <div class="col-md-6">
                                                                <label for=""> Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company <span
                                                                        class="text-danger">*</span> </label>
                                                                <select name="ownership_right[]" id="ownership_right_"
                                                                    class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Yes" @if(isset($annexuredata->ownership_right)
                                                                        &&
                                                                        $annexuredata->ownership_right=="Yes")selected @endif>Yes
                                                                    </option>
                                                                    <option value="No" @if(isset($annexuredata->ownership_right)
                                                                        &&
                                                                        $annexuredata->ownership_right=="No")selected @endif>No
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            </td>
                                                        </tr>
                                                        @endif
                                
                                                    </table>
                                                </span>
                                            </div>

                                        </td>
                                    </tr>

                             <tr>
                               <?php //echo $subAnnexureType; ?>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i> @if(isset($annexuredata->id) &&
                                                $annexuredata->id !='')Update @else Save @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$general->encodeid($annexuredata->id)}}@endif">
                                                <input type="hidden" name="subAnnexureType" id="subAnnexureType"
                                                value="@if(isset($annexuredata->subAnnexureType)){{$annexuredata->subAnnexureType}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$general->encodeid($application_id)}}">
                                            <a href="{{URL::to('users/annexure-four/'.$general->encodeid($application_id))}}"
                                                class="btn btn-danger"><i class="bi bi-x"></i> Cancel </a>
                                        </td>
                                    </tr>
                            </form>
                           
                            
                            <!-- 5.0 Collaboration / Design Ownership Details -->
                             <table class="table table-bordered">
                                    <tr>
                                        <th colspan="3" class=" text-left">5.0 Collaboration / Design Ownership Details</th>
                                    </tr>
                             </table>
                                    
                                    <!-- View data 5.1 Module -->
                                <table class="table table-bordered mt-4">
                                    <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">5.1 Model</th>
                                        </tr>
                                        <tr class="bg-primary text-white">
                                            <th width="10%">S.No </th>
                                            <th scope="col" colspan="15" class="text-left">Type Of Modules</th>
                                        </tr>
                                    </thead>
                                
                                    </tbody>
                                    
                                    @foreach($annexuredata1 as $key=>$annexuremodule)
                                   
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$annexuremodule->module_name}} - <?php echo $annexuremodule->other; ?></td>
                                    </tr>
                                    @endforeach
                                </table><br>

                                <!-- View data 5.2 Module -->
                                <table class="table table-bordered mt-4">
                                    <thead>
                                      <tr>
                                        <th colspan="9" class=" text-left">5.2 Whether Collaboration available for this Solar Photovoltaic(PV) Model Model</th>
                                        </tr>
                                        <tr class="bg-primary text-white">
                                            <th width="10%">S.No </th>
                                            <th>Whether Collaboration available for this Solar Photovoltaic(PV) Model Model </th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //echo '<pre>'; print_r($appData);?>
                                    @php $k = 1;  @endphp
                                    @foreach($appData['estd'] as $data)
                                    <?php
                                   // print_r($data);die;
                                    ?>
                                    <tr>
                                        <td>{{$k++}}</td>
                                        <td>
                                        <table width="100%">
                                                @foreach($data->annexure as $whether_enlisted)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $whether_enlisted->whether_enlisted }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            <!-- {{$data->whether_enlisted}} -->
                                        </td>
                                        <td> <a href="{{URL::to('users/annexure-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/51')}}">
                                            Edit <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>

                                 <!-- View data 5.3 Module -->
                                <table class="table table-bordered text-center mt-4">
                                 <thead>
                                 <tr>
                                        <th colspan="9" class=" text-left">5.3  Collaborator Details</th>
                                        </tr>
                                    <tr class="bg-primary text-white">
                                        <th>S.No</th>
                                        <th width="20%">Name </th>
                                        <th>Country</th>
                                        <th width="25%">Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                  </thead>
                                 <tbody>
                                     @php $s = 1;  @endphp 
                                     <?php //echo '<pre>'; print_r($appData);?>
                                    @foreach($appData['name_cmpny'] as $data)
                                    <?php //echo "<pre/>";print_r($data);?>
                                   
                                    <?php //echo $data->country->country; ?>
                                   
                                    <tr>
                                        <td>{{$s++}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $name_of_company)
                                                  <?php //echo "<pre/>";print_r($data->annexure);?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $name_of_company->name_of_company }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                        <table width="100%">
                                                @foreach($data->annexure as $country)
                                                  <?php //echo "<pre/>";print_r($data->annexure);?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                    @php
                                                    $result =
                                                    \App\Models\Country::select('name')->where('countrycd',$country->country )->first();
                                                    @endphp
                                                    {{ $result['name']}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        
                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $coll_address)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $coll_address->coll_address }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $collab_phone)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $collab_phone->collab_phone }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach($data->annexure as $collab_email)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $collab_email->collab_email }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <a href="{{URL::to('users/annexure-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/5200')}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>

                                <!-- View data 5.4 Module -->
                                <table class="table table-bordered mt-4" id="show_data">
                                            <thead>
                                            <tr>
                                                <th colspan="9" class=" text-left">5.4 Indian Territory Jurisdiction of Collaboration and period of Collaboration</th>
                                                </tr>
                                                <tr class="bg-primary text-white">
                                                    <th width="10%">S.No </th>
                                                    <th>Indian Territory Jurisdiction of Collaboration and period of Collaboration </th>
                                                    <!-- <th width="10%">Period</th> -->
                                                    <th width="10%">From</th>
                                                    <th width="10%">To</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $t = 1;  @endphp 
                                            <?php //echo '<pre>'; print_r($appData);?>
                                            @foreach($appData['ind_terr'] as $data)
                                            <?php
                                        // print_r($data);die;
                                            ?>
                                            <tr>
                                                <td>{{$t++}}</td>
                                                <td>
                                                <table width="100%">
                                                @foreach($data->annexure as $ind_territory)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $ind_territory->ind_territory }}</td>
                                                </tr>
                                                @endforeach
                                                </table>
        
                                                </td>
                                                <!-- <td>
                                                    <table width="100%">
                                                @foreach($data->annexure as $period)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $period->period }}</td>
                                                </tr>
                                                @endforeach
                                                </table>
                                                </td> -->
                                                <td>
                                                    <table width="100%">
                                                @foreach($data->annexure as $from_ind)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                            @php
                                                                    $date = new DateTime($from_ind->from_ind);
                                                            @endphp
                                                            {{ $date->format('d-m-Y') }}
                                                </tr>
                                                @endforeach
                                                </table>
                                                    
                                                </td>
                                                <td>
                                                <table width="100%">
                                                    @foreach($data->annexure as $to_ind)
                                                        <tr>
                                                            <td style="border-bottom:1px solid #ccc;">
                                                                @php
                                                                    $date = new DateTime($to_ind->to_ind);
                                                                @endphp
                                                                {{ $date->format('d-m-Y') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                                </td>
                                                <td> <a href="{{URL::to('users/annexure-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/53')}}">
                                                    Edit <i class="fa fa-edit"></i></a>
                                                    <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                                </td> 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </table>

                                <!-- View data 5.5 Module -->
                                <table class="table table-bordered mt-4" id="show_data">
                                    <thead>
                                      <tr>
                                        <th colspan="9" class=" text-left">5.5 Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company </th>
                                        </tr>
                                        <tr class="bg-primary text-white">
                                            <th width="10%">S.No </th>
                                            <th>Owner of design rights of the Solar Photovoltaic(PV) Module Model available with the Indian Company </th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $j = 1;  @endphp 
                                    <?php //echo '<pre>'; print_r($appData);?>
                                    @foreach($appData['ownership'] as $data)
                                    
                                    <?php
                                   //print_r($data);die;
                                    ?>
                                    <tr>
                                        <td>{{$j++}}</td>
                                        <td>
                                        <table width="100%">
                                               @foreach($data->annexure as $ownership_right)
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        {{ $ownership_right->ownership_right }}</td>
                                                </tr>
                                                @endforeach
                                               
                                                </table>
                                            
                                        </td>
                                        <td> <a href="{{URL::to('users/annexure-four/'.$general->encodeid($data->application_id).'/'.$general->encodeid($data->id).'/54')}}">
                                            Edit <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$general->encodeid($data->id))}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table><br>
                                
                                <div class="row">
                                <div class="col-lg-12 text-center">
                                 <a href="{{URL::to('users/annexure-three/'.$general->encodeid($application_id))}}"
                                        class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>Back</a>
                                    
                                    <a href="{{URL::to('/users/annexure-four-two/'.$general->encodeid($application_id))}}"
                                        class="btn btn-warning">Next <i class="bi bi-arrow-bar-right"></i></a>
                                  
                                </div>
                            </div><br>
                        </div>
                      </div>
                        
                    <!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleAdditionalFields(select) {
        var value = select.value;
        if (value == 'yes') {
            $('#additionalFields').slideDown(); // Show additional fields
        } else {
            $('#additionalFields').slideUp(); // Hide additional fields
        }
    }

    // Initialize based on current selection
    $(document).ready(function() {
        var selectedValue = $('#ind_territory_').val();
        if (selectedValue == 'yes') {
            $('#additionalFields').slideDown(); // Show additional fields initially if 'Yes' is selected
        }
    });
</script>

    <style>
    .invalid-feedback {
        position: inherit !important;
        margin-top: -15px;
        width: 100%;
        font-size: .875em;
        color: #dc3545;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    $('#whether_enlisted').change(function() {
        $('#noofpv_models').attr('readonly', 'readonly').val('0');
        if (this.value == 'Yes') {
            $('#noofpv_models').removeAttr('readonly');
        }
        //background-color: #ccc !important;
    });
    </script>
    @endpush