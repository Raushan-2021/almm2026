@extends('layouts.masters.backend')
@section('content')
@section('title', 'Maintenance Registry')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <form id="maintenanceRegistryForm" action="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-record/'.base64_encode($record->id))}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-header with-border text-right">
                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-records/'.base64_encode($record->system_id))}}" class="btn btn-info btn-xs">Back</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="request_code">{{ __('Maintenance Request ID') }} <span class="error">*</span></label>
                                <input type="text" disabled class="form-control required" name="request_code" value="{{$record['request_code'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="maintenance_code">{{ __('Maintenance Registry ID') }} <span class="error">*</span></label>
                                <input type="text" disabled class="form-control required" name="maintenance_code" value="{{$record['maintenance_code'] ?? 'Not Generated'}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">{{ __('Scheduled Maintenance Date') }} <span class="error">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" disabled class="form-control required datepicker" name="scheduled_date" value="@if(!empty($record['scheduled_date'])) {{date('d-m-Y', strtotime($record['scheduled_date']))}} @endif">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bpmr_no">{{ __('System ID') }} <span class="error">*</span></label>
                                <input type="text" disabled class="form-control required" name="bpmr_no" value="{{$record['bpmr_no'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">{{ __('Type of maintenance') }} <span class="error">*</span></label>
                                <select class="form-control" name="type" disabled>
                                    <option value="PR" @if($record['type'] == "PR") selected @endif>Preventive</option>
                                    <option value="CR" @if($record['type'] == "CR") selected @endif>Curative</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="installer">{{ __('Installer ID') }} <span class="error">*</span></label>
                                <input type="text" disabled class="form-control required" name="installer" value="{{$record['installer_id'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                    @if (isset($record['request_note']) && !empty($record['request_note']))
                        <div class="row">
                            <div class="col-md-12">
                                <label for="note">{{ __('Notes of Maintenance work to be done') }}</label>
                                <textarea class="form-control" disabled name="request_note" cols="30" rows="5">{{$record['request_note'] ?? ''}}</textarea>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="maintenance_date">{{ __('Actual Maintenance Date') }} <span class="error">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" {{$editable ?? ''}} class="form-control required datepicker" name="maintenance_date" value="@if(!empty($record['maintenance_date'])) {{date('d-m-Y', strtotime($record['maintenance_date']))}} @endif" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-15">
                        <div class="col-md-4 @if(($editable ?? '') !== '') hidden @endif">
                            <div class="form-group">
                                <label for="images">{{ __('Pictures of Maintenance work done') }} <span class="error">*</span></label>
                                <input type="file" {{$editable ?? ''}} class="form-control required" multiple="multiple" name="images[]">
                            </div>
                        </div>
                    </div>
                    @if (!empty($record['images']))
                        <div class="row mt-15">
                            <div class="col-md-12">
                                <div class="form-group pb-25">
                                    <label for="">Pictures of Maintenance work done</label>
                                    <br>
                                    @foreach ($record['images'] as $key => $image)
                                        <a class="@if($key) ml-20 @endif" href="{{url(Auth::getDefaultDriver().'/preview-docs/'.base64_encode($record['consumer_code']).'/'.base64_encode('maintenance').'/'.$image->name.'/'.$record['maintenance_code'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                                        <a class="ml-5 download-link" href="{{url(Auth::getDefaultDriver().'/download-docs/'.base64_encode($record['consumer_code']).'/'.base64_encode('maintenance').'/'.$image->name.'/'.$record['maintenance_code'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        @if (Auth::getDefaultDriver() !== 'installer')
                            <h5 class="mb-25 text-bold text-red">Images not uploaded</h5>
                        @endif
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description">{{ __('Description of Maintenance work done') }}</label>
                            <textarea class="form-control" {{$editable ?? ''}} name="description" cols="30" rows="5">{{$record['description'] ?? ''}}</textarea>
                        </div>
                    </div>
                    @if (Auth::getDefaultDriver() === "installer")
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info @if(($editable ?? '') !== '') hidden @endif">Submit</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
    <script>
        $(function(){
            $(".datepicker").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                orientation: "bottom",
                startDate: new Date()
            });

            $("#maintenanceRegistryForm").validate();
        });
    </script>
@endpush
