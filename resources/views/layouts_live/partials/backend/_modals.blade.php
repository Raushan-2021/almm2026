<!-- Modal -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="uploadExcelForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="consumerApprovalModalLabel">Upload CSV</h4>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" name="excel_file">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="uploadSubmitButton" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Consumer Approval Modal -->
<div class="modal fade" id="consumerApprovalModal" tabindex="-1" role="dialog" aria-labelledby="consumerApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="consumerApprovalModalLabel">Consumer Request</h4>
                </div>
                <div class="modal-body">
                    <h5>Do you want to <span id="action"></span> consumer request ?</h5>
                </div>
                <div class="modal-footer">
                    <a href="" id="approvalLink" class="btn btn-primary">Yes</a>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Installation Approval Modal -->
<div class="modal fade" id="installationApprovalModal" tabindex="-1" role="dialog" aria-labelledby="installationApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="installationApprovalModalLabel">System Accept/Reject</h4>
                </div>
                <div class="modal-body">
                    <h5>Do you want to <span id="action"></span> system ?</h5>
                </div>
                <div class="modal-footer">
                    <a href="" id="approvalLink" class="btn btn-primary">Yes</a>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Installation Modification Modal -->
<div class="modal fade" id="installationRejectionModal" tabindex="-1" role="dialog" aria-labelledby="installationRejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="installationRejectionForm">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="installationRejectionModalLabel">System Reject</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rejection_reason">{{ __('What are the reasons of system rejection ?') }}</label>
                        <textarea class="form-control required" name="rejection_reason" cols="30" rows="7" placeholder="Write here..."></textarea>
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

<!-- Installation Modification Modal -->
<div class="modal fade" id="installationModificationModal" tabindex="-1" role="dialog" aria-labelledby="installationModificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="installationModificationForm">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="installationModificationModalLabel">System Modifications</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="modifications">{{ __('What modifications need to system ?') }}</label>
                        <textarea class="form-control required" name="modifications" cols="30" rows="7" placeholder="Write here..."></textarea>
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


@isset($installers)
<!-- consumer installaer association Modal -->

@endisset
@isset($inspectors)
<!-- consumer Approval Modal -->

@endisset


<!-- user blacklist modal -->
<div class="modal fade" id="usersBlacklistModal" tabindex="-1" role="dialog" aria-labelledby="usersBlacklistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="usersBlacklistModalLabel">Blacklist Request</h4>
                </div>
                <div class="modal-body">
                    <h5>Do you want to <span id="action"></span> ?</h5>
                </div>
                <div class="modal-footer">
                    <a href="" id="blacklistLink" class="btn btn-primary">Yes</a>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div>
