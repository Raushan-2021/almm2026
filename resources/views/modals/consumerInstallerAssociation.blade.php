<div class="modal fade" id="consumerInstallerModal" role="dialog" aria-labelledby="consumerInstallerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="consumerInstallerForm">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="consumerInstallerModalLabel">Consumer Installer Association</h4>
                </div>
                <div class="modal-body">
                    @isset($installers)
                        <div class="form-group">
                            <label for="">Select Installer</label>
                            <select class="form-control required" name="installer_id">
                                <option value="" selected disabled>Select Installer</option>
                                @foreach ($installers as $installer)
                                    <option value="{{$installer->id}}">{{$installer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">System Priority</label>
                            <select class="form-control required" name="priority">
                                <option value="" selected disabled>Select Priority</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Associate</button>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div>