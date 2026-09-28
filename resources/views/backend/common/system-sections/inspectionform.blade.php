@php $docBaseUrl = Auth::getDefaultDriver().'/preview-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('inspection').'/'; @endphp
@php $docDownloadUrl = Auth::getDefaultDriver().'/download-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('inspection').'/'; @endphp
<div class="box-body">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inspection_id">{{ __('Inspection ID') }} <span class="error">*</span></label>
                    <input type="text" disabled class="form-control required" name="inspection_id" value="{{$installation->inspectionUniqueId ?? 'Not Generated'}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="date">{{ __('Date of inspection') }} <span class="error">*</span></label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control required datepicker" name="date" disabled value="@if(!empty($installation->inspectionDate)) {{date('d-m-Y', strtotime($installation->inspectionDate))}} @endif" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inspectorId">{{ __('Inspector ID') }} <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="inspectorId" disabled value="{{$installation->inspectorUniqueId ?? ''}}">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                     <label for="installer_name">Installer Name</label>
                     <input type="text" class="form-control" disabled name="installer_name" value="{{$installation->installer ?? ''}}">
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                     <label for="installer_id">Installer ID</label>
                     <input type="text" class="form-control" disabled name="installer_id" value="{{$installation->installerUniqueId ?? ''}}">
                </div>
             </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-5">
                            <label for="appropriate_location">Whether the biogas plant was found at the appropriate location ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="appropriate_location" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->appropriate_location ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->appropriate_location ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="beneficiary_feeding_plant">Whether the biogas plant is fed properly by the beneficiary ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="beneficiary_feeding_plant" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->beneficiary_feeding_plant ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->beneficiary_feeding_plant ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="biogas_production_optimum_level">Whether the biogas plant is producing biogas at its optimum level ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="biogas_production_optimum_level" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->biogas_production_optimum_level ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->biogas_production_optimum_level ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="plant_connected_to_pipeline">Whether the biogas plant is connected with pipeline ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="plant_connected_to_pipeline" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->plant_connected_to_pipeline ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->plant_connected_to_pipeline ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="biogas_used_at_kitchen">Whether the biogas plant is used at kitchen ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="biogas_used_at_kitchen" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->biogas_used_at_kitchen ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->biogas_used_at_kitchen ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="optimum_quantity_of_biogas_slurry_produced">Whether the biogas plant produced optimum quantity of biogas slurry ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="optimum_quantity_of_biogas_slurry_produced" disabled>
                                <option selected disabled>Select Option</option>
                                <option value="1" @if(($installation->optimum_quantity_of_biogas_slurry_produced ?? '') == '1') selected @endif>Yes</option>
                                <option value="0" @if(($installation->optimum_quantity_of_biogas_slurry_produced ?? '') == '0') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-5">
                            <label for="slurry_used_for_agriculture_business">Whether the beneficiary is using the slurry in agriculture or for business ?</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="slurry_used_for_agriculture_business" disabled>
                                <option selected disabled>Select Option</option>
                                @foreach($slurry_types as $slurry)
                                <option value="{{$slurry['code']}}" @if(($installation->slurry_used_for_agriculture_business ?? '') == $slurry['code']) selected @endif>{{$slurry['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pic_of_plant_with_family_member">{{ __('Picture of biogas plant with anyone of the family member') }} <span class="error">*</span></label>
                    <input type="file" {{$editableInspector ?? ''}} class="form-control required" name="pic_of_plant_with_family_member">
                    @if (!empty($installation->pic_of_plant_with_family_member))
                        @php $image = json_decode($installation->pic_of_plant_with_family_member, true); @endphp
                        <div class="mb-10">
                            <a class="" href="{{URL::to($docBaseUrl.$image['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                            <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$image['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pic_of_stove_with_flame">{{ __('Picture of biogas stove with flame') }} <span class="error">*</span></label>
                    <input type="file" {{$editableInspector ?? ''}} class="form-control required" name="pic_of_stove_with_flame">
                    @if (!empty($installation->pic_of_stove_with_flame))
                        @php $image = json_decode($installation->pic_of_stove_with_flame, true); @endphp
                        <div class="mb-10">
                            <a class="" href="{{URL::to($docBaseUrl.$image['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                            <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$image['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="recommendations">Recommendations</label>
            <textarea class="form-control" disabled name="recommendations" id="" cols="30" rows="5">{{$installation->recommendations ?? ''}}</textarea>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="approval">Approval</label>
                    <select class="form-control required" name="approval" id="approval" disabled>
                        <option value="">Select Option</option>
                        <option value="1" @if(($installation->inspectionApproval ?? '') == '1') selected @endif>Yes</option>
                        <option value="0" @if(($installation->inspectionApproval ?? '') == '0') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    @if (Auth::getDefaultDriver() == 'state-implementing-agency' && $installation->installation_status == 8)
    <div class="box-footer">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="approveSystem('{{URL::to('/'.Auth::getDefaultDriver().'/system/'.base64_encode($installation->id).'/complete/AP')}}')">Approve System</a>
    </div>
    @endif
</div>