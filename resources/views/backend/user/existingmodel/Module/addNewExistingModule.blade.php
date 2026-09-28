@inject('general', 'App\Http\Controllers\Backend\Users\MainController')
@extends('layouts.masters.backend')
@section('title', 'Module Master')
@section('content')

<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm"
                                href="{{URL::to('users/module-existing-master/'.$general->encodeid($id))}}"><i
                                    class="fa fa-arrow"></i> Back</a>
                        </div>

                        <div class="box-body">
                            <form action="{{ URL::to('/users/addExistingModule')}}" method="POST"
                                enctype="multipart/form-data" id="formAjax">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Type of Modules</label>
                                                    <select name="module_type"
                                                        class="form-control  @error('module_type') is-invalid @enderror"
                                                        id="module_type">
                                                        <option value="">Select Module Type</option>
                                                        @foreach($modulelist as $model)
                                                        <option value="{{$model->id}}" @if(($moduleData->module_type ??
                                                            '')==$model->id) selected @endif >{{$model->module_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('module_type') <br><span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="main_model" placeholder="Main Model"
                                                        id="main_model"
                                                        class="form-control @error('main_model') is-invalid @enderror"
                                                        maxlength="70" value="{{$moduleData->main_model ?? ''}}">
                                                    @error('main_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="number" step="any" min="0" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control @error('pmax_model') is-invalid @enderror"
                                                        maxlength="70" value="{{$moduleData->pmax_model ?? '0'}}">
                                                    @error('pmax_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <table class="table table-bordered1">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Applicable models covered under +- 5%, Pmax of Main
                                                                Model</th>
                                                            <th>Pmax (Wp) of Applicable Models Model</th>
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
                                                                    @if($loop->iteration==1)
                                                                    <a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                    @else
                                                                    <a href="javascript:;" class="remove_fields">Delete
                                                                        <i class="fa fa-trash text-danger"></i></a>
                                                                    @endif
    
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
                                                                <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                </td>

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
                                            <input type="submit" name="submit"
                                                value="@if(isset($moduleData->applicable_model))Update @else Save @endif"
                                                class="btn btn-success">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($moduleData->id)){{$general->encodeid($moduleData->id)}}@else @endif">
                                            <input type="hidden" name="app_id"
                                                value="{{$general->encodeid($id) ?? ''}}">
                                            <a href="{{URL::to('/users/module-existing-master/'.$general->encodeid($id))}}"
                                                class="btn btn-danger"> Cancel </a>

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
    let counter = $('#add-data tr').length;
    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {
            $(this).closest('.record').remove();
            counter = counter - 1;
        });
        //<button type="button" class="remove_fields btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        $("#add-row").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_model_covered[]" id="applicable_model_covered_' +
                counter +
                '" placeholder="Enter Applicable models covered under +- 5%" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="number"  min="0" step="any" name="applicable_model[]" id="applicable_model_' +
                counter +
                '" placeholder="Enter Pmax (Wp) of Applicable Models" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    <script>
    // JavaScript to toggle the visibility of the input field when 'Other' is selected
    document.getElementById('module_type').addEventListener('change', function() {
        var otherField = document.getElementById('otherModuleField');
        if (this.value == '17') {
            otherField.style.display = 'block'; // Show the input field when 'Other' is selected
        } else {
            otherField.style.display = 'none'; // Hide the input field when any other option is selected
        }
    });
</script>
    @endpush