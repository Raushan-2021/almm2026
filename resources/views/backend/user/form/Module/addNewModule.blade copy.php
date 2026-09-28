back up 
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


                                <a href="javascript:;" id="add-row">Add
                                <i class="fa fa-plus text-success"></i></a>

                                <table id="abc">
                                    <tr><td>

                                <table class="table table-bordered" id="show_data">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Module Technology</label><small
                                                    class="text-danger"> * </small>
                                                    <select name="module_type"
                                                        class="form-control  @error('module_type') is-invalid @enderror"
                                                        id="module_type">
                                                        <option value="">Select Module Technology</option>
                                                        @foreach($modulelist as $model)
                                                        <option value="{{$model->id}}" @if(($moduleData->module_type ?? '')==$model->id) selected @endif >{{$model->module_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('module_type') 
                                                    <br><span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> 
                                                        @enderror

                                                        <div id="other_module_input" style="display: none;">
                                                                <label for="other_module_title">Other Module Technology Name</label>
                                                                <input type="text" name="other_module_title[]" id="other_module_title" class="form-control">
                                                        </div>

                                                    </div>
 
                                                <!-- <div class="col-md-4">
                                                    <label for="">Representative Main Model</label><small
                                                    class="text-danger"> * </small>
                                                    <input type="text" name="main_model[]" placeholder="Main Model"
                                                        id="main_model"
                                                        class="form-control @error('main_model') is-invalid @enderror"
                                                        maxlength="70" value="{{$moduleData->main_model ?? '0'}}">
                                                    @error('main_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div> -->
                                                <!-- <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label><small
                                                    class="text-danger"> * </small>
                                                    <input type="number" step="any" min="0" name="pmax_model[]"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control @error('pmax_model') is-invalid @enderror"
                                                        maxlength="70" value="{{$moduleData->pmax_model ?? '0'}}">
                                                    @error('pmax_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div> -->

                                                <div class="col-md-12">
                                                    <table class="table table-bordered1">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Applicable models covered under +- 5%, Pmax of Main
                                                                Model<br>
                                                                <small class="text-center text-primary">(* Should
                                                                    include main Module also. <br>All Models
                                                                    should be included in Valid BIS Certificate) </small>
                                                            </th>
                                                            <th>Pmax (Wp) of Applicable Models Model<small
                                                            class="text-danger"> * </small></th>
                                                            <th></th>

                                                        </tr>
                                                        <tbody id="add-data">

                                                            @if($moduleData!=null)
                                                            @foreach($moduleData->applicable_model_covered as $value)
                                                            <tr class="record">
                                                                <td>{{$loop->iteration}}</td>
                                                                <td> <input type="text"
                                                                        name="applicable_model_covered[]"
                                                                        id="applicable_model_covered_{{$loop->iteration}}"
                                                                        placeholder="Enter Applicable models covered under +- 5% "
                                                                        value="{{$value}}">
                                                                </td>
                                                                <td> <input type="number" name="applicable_model[]"
                                                                        id="applicable_model_{{$loop->iteration}}"
                                                                        min="0" step="any"
                                                                        placeholder="Enter Pmax (Wp) of Applicable Models"
                                                                        value="{{$moduleData->applicable_model[$loop->iteration-1]}}">
                                                                </td>
                                                                <td width="8%">
                                                                   <!-- @if($loop->iteration==1)
                                                                    <a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                    @else
                                                                    <a href="javascript:;" class="remove_fields">Delete
                                                                        <i class="fa fa-trash text-danger"></i></a>
                                                                    @endif-->

                                                                </td>
                                                                
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td>1</td>
                                                                <td> <input type="text"
                                                                        name="applicable_model_covered[]"
                                                                        id="applicable_model_covered"
                                                                        placeholder="Enter Applicable models covered under +- 5% ">
                                                                </td>
                                                                <td> <input type="number" name="applicable_model[]"
                                                                        id="applicable_model" min="0" step="any"
                                                                        placeholder="Enter Pmax (Wp) of Applicable Models">
                                                                </td>
                                                                
                                                               <!-- <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                </td>-->

                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                  
                                                   
                                                </div>

                                            </div>
                                        </th>
                                    </tr>
                                    
                                </table>
                                </td>
                                </tr>
                                </table>

                                <tr>
                                        <td>
                                            <!-- condition1 ? condition2 ? Expression1 : Expression2 : Expression3 -->
                                            <button type="submit" name="submit" class="btn btn-success" id="submit"><i
                                                    class='bi bi-arrow-bar-up'></i>
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
    let counter = $('#add-data tr').length;
    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {
            $(this).closest('.record').remove();
            counter = counter - 1;
        });
        //<button type="button" class="remove_fields btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        /* markup =
                '<tr class="record"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_model_covered[]" id="applicable_model_covered_' +
                counter +
                '" placeholder="Enter Applicable models covered under +- 5%" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="number"  min="0" step="any" name="applicable_model[]" id="applicable_model_' +
                counter +
                '" placeholder="Enter Pmax (Wp) of Applicable Models" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';*/


         
        $("#add-row").click(function() {
            counter = counter + 1;
           
            markup ='<tr><td><table class="table table-bordered" id="show_data"><tr><th><div class="row"><div class="col-md-4"><label for="">Module Technology</label><select name="module_type"class="form-control  is-invalid " id="module_type"><option value="">Select Module Technology</option>@foreach($modulelist as $model)<option value="{{$model->id}}" @if(($moduleData->module_type ?? '')==$model->id) selected @endif >{{$model->module_name}}</option>@endforeach </select> @error('module_type')<br><span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span>@enderror <div id="other_module_input" style="display: none;"><label for="other_module_title">Other Module Technology Name:</label><input type="text" name="other_module_title[]" id="other_module_title" class="form-control"></div></div><div class="col-md-4"><label for="">Representative Main Model</label><input type="text" name="main_model[]" placeholder="Main Model" id="main_model" class="form-control @error('main_model') is-invalid @enderror" maxlength="70" value="{{$moduleData->main_model ?? ''}}">@error('main_model') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span> @enderror </div><div class="col-md-4"><label for="">Pmax (Wp) of Main Model</label><input type="number" step="any" min="0" name="pmax_model[]" placeholder="Pmax (Wp) of Main Model" id="pmax_model" class="form-control @error('pmax_model') is-invalid @enderror"maxlength="70" value="{{$moduleData->pmax_model ?? '0'}}">@error('pmax_model') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span> @enderror </div><div class="col-md-12"><table class="table table-bordered1"> <tr><th>S.No</th><th>Applicable models covered under +- 5%, Pmax of Main Model<br><small class="text-center text-primary">(* Should include main Module also. <br>All Models should be included in Valid BIS Certificate)</small></th><th>Pmax (Wp) of Applicable Models Model</th><th></th><th></th></tr><tbody id="add-data">@if($moduleData!=null)@foreach($moduleData->applicable_model_covered as $value)<tr class="record"><td>{{$loop->iteration}}</td><td> <input type="text" name="applicable_model_covered[]" id="applicable_model_covered_{{$loop->iteration}}" placeholder="Enter Applicable models covered under +- 5% " value="{{$value}}"></td><td> <input type="number" name="applicable_model[]" id="applicable_model_{{$loop->iteration}}" min="0" step="any" placeholder="Enter Pmax (Wp) of Applicable Models" value="{{$moduleData->applicable_model[$loop->iteration-1]}}"></td><td width="8%"></td></tr>@endforeach @else <tr> <td>'+counter+'</td> <td> <input type="text" name="applicable_model_covered[]" id="applicable_model_covered" placeholder="Enter Applicable models covered under +- 5% "></td><td> <input type="number" name="applicable_model[]" id="applicable_model" min="0" step="any" placeholder="Enter Pmax (Wp) of Applicable Models"> </td><td><a href="javascript:;" class="remove-row"><i class="fa fa-trash text-danger" style="padding-top: 10;"></i></a></td></tr>@endif</tbody></table></div></div></th></tr></td></tr>';

            tableBody = $("#abc");
            tableBody.append(markup);
        });
        
        $(document).on("click", ".remove-row", function() {
        $(this).closest("tr").remove();
    });
    });

    $(document).ready(function() {
    $('#module_type').change(function() {
        if ($(this).val() == '17') {  
            $('#other_module_input').show();  
        } else {
            $('#other_module_input').hide(); 
        }
    });
});

    </script>
  


    @endpush
	
	
	
	