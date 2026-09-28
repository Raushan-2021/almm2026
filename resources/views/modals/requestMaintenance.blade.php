<div class="modal fade" id="requestMaintenanceModal" role="dialog" aria-labelledby="requestMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{URL::to('/'.Auth::getDefaultDriver().'/maintenance-records/'.base64_encode($systemId))}}" method="POST" id="requestMaintenanceForm">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="requestMaintenanceModalLabel">Request Maintenance</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">{{ __('Type of maintenance') }} <span class="error">*</span></label>
                        <select class="form-control required" name="type">
                            <option selected disabled>Select Maintenance Type</option>
                            <option value="PR">Preventive</option>
                            <option value="CR">Curative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">{{ __('Scheduled Maintenance Date') }} <span class="error">*</span></label>
                        <input type="text" class="form-control required datepicker" name="date" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="note">{{ __('Notes of Maintenance work to be done') }}</label>
                        <textarea class="form-control" name="note" cols="30" rows="5" placeholder="Write here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
