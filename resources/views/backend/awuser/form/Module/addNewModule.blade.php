
@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'Module Master')
@section('content')
@include('backend.user.form._stepper_application')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm"
                                href="{{URL::to('users/module-master/'.$general->encodeid($id))}}"><i
                                    class="fa fa-arrow"></i> Back</a>
                        </div>

                        <div class="box-body">
                            <form action="{{ URL::to('/users/addModule')}}" method="POST" id="formAjax">
                                @csrf
                                @method('POST')
                                <div class="row">
                                @if($moduleData!=null)
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Module Technology:</strong></label>
                                <select name="module_type"
                                                                        class="form-control  @error('module_type') is-invalid @enderror"  id="module_type">
                                                                        <option value="">Select Module add Technology</option>
                                                                        @foreach($modulelist as $model)
                                                                        <option value="{{$model->id}}" 
                                                                        @if(($moduleData->module_type ?? '')==$model->id) selected @endif >{{$model->module_name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3 otheradd" style="display : none;">
                                <label for="email" class="form-label"><strong>Other</strong></label>
                                <input type="text" class="form-control" id="email" name="email">
                                <input type="text" name="other" class="otheradd" palceholder="Add others if any" style="display : none;">
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Model Name:</strong></label>
                                <input type="text" class="form-control" id="main_model_name" name="main_model_name" value="{{$moduleData->main_model_name}}">
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Wattage of applied main model (W)</strong></label>
                                <input type="text" class="form-control" id="main_wattage" name="main_wattage" value="{{$moduleData->main_wattage}}">
                                </div>
                                @else
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Module Technology:</strong></label>
                                <select name="module_type"
                                                                        class="form-control  @error('module_type') is-invalid @enderror"  id="module_type">
                                                                        <option value="">Select Module add Technology</option>
                                                                        @foreach($modulelist as $model)
                                                                        <option value="{{$model->id}}" 
                                                                        @if(($moduleData->module_type ?? '')==$model->id) selected @endif >{{$model->module_name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3 otheradd" style="display : none;">
                                <label for="email" class="form-label"><strong>Other</strong></label>
                                <input type="text" class="form-control" id="email" name="email">
                                <input type="text" name="other" class="otheradd" palceholder="Add others if any" style="display : none;">
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Model Name:</strong></label>
                                <input type="text" class="form-control" id="main_model_name" name="main_model_name">
                                </div>
                                <div class="col-xl-3 col-lg-6 pb-3">
                                <label for="email" class="form-label"><strong>Wattage of applied main model (W)</strong></label>
                                <input type="text" class="form-control" id="main_wattage" name="main_wattage">
                                </div>
                                @endif
                                </div>
                                
                                <table class="table table-bordered" id="show_data">
                                    <tr>
                                        <th>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered1">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Module Names of Sub-models applied for enlistment <small class="text-center text-danger"> * </small></th>
                                                            <th>Wattage of applied Sub-models applied for enlistment<small class="text-center text-danger"> * </small>
                                                            <th>No. & type of cells in module (eg. 144 Half-Cut cells)<small class="text-center text-danger"> * </small>
                                                            <th>Max System Voltage<small class="text-center text-danger"> * </small>
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                        <tbody id="add-data">
                                                            @if($moduleData!=null)
                                                        <?php $u = 1; foreach($subModuleData as $val){?>
                                                            <tr class="record">
                                                                <td><?php echo $u; ?></td>
                                                                <td width="20%"> <input type="text"
                                                                        name="sub_model_name[]"
                                                                        id="sub_model_name"
                                                                         value="{{$val->sub_model_name ?? '' }}"></td>

                                                                          <td width="20%"> <input type="text"
                                                                        name="sub_model_wattage[]"
                                                                        id="sub_model_wattage"
                                                                         value="{{$val->sub_model_wattage ?? '' }}"></td>

                                                                        <td width="20%"> <input type="text"
                                                                        name="cell_type[]"
                                                                        id="cell_type"
                                                                         value="{{$val->cell_type ?? '' }}"></td>
                                                                        
                                                                <td width="20%"> <input type="text"
                                                                        name="max_system_volatge[]"
                                                                        id="max_system_volatge"
                                                                         value="{{$val->max_system_volatge ?? '' }}"></td>
                                                              
                                                                <td width="10%"><a href="javascript:;" id="add-row">Add<i class="fa fa-plus text-success"></i></a></td>
                                                            </tr>
                                                            <?php $u++; } ?>

                                                            @else
                                                            <tr>
                                                                <td>1</td>-
                                                            <!--    <td width="40%"> 
                                                                    <select name="module_type[]"
                                                                        class="form-control  @error('module_type') is-invalid @enderror"  id="module_type" onchange="hideshow_otherfield(this.value,'1')">
                                                                        <option value="">Select Module add Technology</option>
                                                                        @foreach($modulelist as $model)
                                                                        <option value="{{$model->id}}" 
                                                                        @if(($moduleData->module_type ?? '')==$model->id) selected @endif >{{$model->module_name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="text" name="other[]" id="otheradd_1" palceholder="Add others if any" style="display : none;">
                                                                    @error('module_type') 
                                                                    <br><span class="invalid-feedback valid_class"
                                                                        role="alert"> {{ $message }} </span> 
                                                                        @enderror</td> -->
                                                                        <td width="20%"> <input type="text"
                                                                        name="sub_model_name[]"
                                                                        id="sub_model_name"
                                                                         value="{{$moduleData->sub_model_name ?? '' }}"></td>

                                                                                                                                        <td width="20%"> <input type="number"
                                                                        name="sub_model_wattage[]"
                                                                        id="sub_model_wattage"
                                                                         value="{{$moduleData->sub_model_wattage ?? '' }}"></td>

                                                                        <td width="20%"> <input type="text"
                                                                        name="cell_type[]"
                                                                        id="cell_type"
                                                                         value="{{$moduleData->cell_type ?? '' }}"></td>
                                                                        
                                                                <td width="20%"> <input type="number"
                                                                        name="max_system_volatge[]"
                                                                        id="max_system_volatge"
                                                                         value="{{$moduleData->max_system_volatge ?? '' }}"></td>
                                                              
                                                                <td width="10%"><a href="javascript:;" id="add-row">Add<i class="fa fa-plus text-success"></i></a></td>
                                                            </tr>
                                                            @endif
                                                       
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <!-- condition1 ? condition2 ? Expression1 : Expression2 : Expression3 -->
                                            <button type="submit" name="submit" class="btn btn-success" id="submit">
                                                <i class='bi bi-arrow-bar-up'></i>
                                                @if(isset($moduleData->applicable_model))Update @else Save
                                                @endif</button>
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($moduleData->id)){{$general->encodeid($moduleData->id)}}@else @endif">
                                            <input type="hidden" name="app_id"
                                                value="{{$general->encodeid($id) ?? ''}}">
                                            <a href="{{URL::to('/users/module-master/'.$general->encodeid($id))}}"
                                                class="btn btn-danger"> <i class='bi bi-x'></i> Cancel </a>
                                        </td>
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
        </div>
    </div>
    <style>
    .valid_class {
        color: #d34f4f;
        font-size: 10px;
        font-weight: 600;
        margin-top: -16px;
        position: absolute;
    }
    </style>

    @endsection
    @push('backend-js')

    <script>
// JavaScript to show/hide the 'Other' text field when the 'Other' option is selected
document.getElementById('module_type').addEventListener('change', function() {
    // alert("hello");
    var otherOption = this.value;
    var otherContainer = document.getElementById('otheradd');
    // alert(otherOption);
    if (otherOption == '17') {
        otherContainer.style.display = 'block';  // Show the text input for "Other"
    } else {
        otherContainer.style.display = 'none';  // Hide the text input for "Other"
    }
});

function hideshow_otherfield(otherOption,cnt)
{
   // alert(cnt);
    var otherContainer = document.getElementById('otheradd_'+cnt);
    // alert(otherOption);
    if (otherOption == '17') {
        otherContainer.style.display = 'block';  // Show the text input for "Other"
    } else {
        otherContainer.style.display = 'none';  // Hide the text input for "Other"
    }
}
function hideshow_otherfield1(otherOption,cnt)
{
   // alert(cnt);
    var otherContainer = document.getElementById('otheradd_'+cnt);
    // alert(otherOption);
    if (otherOption == '17') {
        otherContainer.style.display = 'block';  // Show the text input for "Other"
    } else {
        otherContainer.style.display = 'none';  // Hide the text input for "Other"
    }
}
</script>

<script>
    let counter = $('#add-data tr').length;
    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {
            $(this).closest('.record').remove();
            counter = counter - 1;
        });
       
        $("#add-row").click(function() {   
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter +
            /*    '</td><td><select name="module_type[]" class="form-control   @error('module_type') is-invalid @enderror"    onchange="hideshow_otherfield(this.value,'+counter+')"><option value="">Select Module Technology</option> @foreach($modulelist as $model)<option value="{{$model->id}}"' +
                counter +
                '@if(($moduleData->module_type ?? '')==$model->id) selected @endif>{{$model->module_name}} </option> @endforeach</select><input type="text" name="other[]" style="display:none;" id="otheradd_'+counter+'" >@error('module_type')<br> ' + 
            
                counter +
                '<span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span>@enderror</td>' +
                    
                counter + */
                '</td><td><input type="text" name="sub_model_name[]"  class="form-control pmax_applicable_model_' +
     
                counter +
                '"></td><td><input type="number" name="sub_model_wattage[]"  class="form-control nmax_applicable_model_' +
                counter +
                '"></td><td><input type="text" name="cell_type[]" class="form-control ymax_applicable_model_' +
                counter +
                '"></td><td><input type="number" name="max_system_volatge[]" class="form-control tmax_applicable_model_' +
                counter +
                '"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
</script>
@endpush
	