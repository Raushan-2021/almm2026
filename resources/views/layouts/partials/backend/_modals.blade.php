<!-- Modal 
<div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="uploadExcelModalLabel"
    aria-hidden="true">
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
</div>-->


<div class="modal fade" id="ExErrorModal" tabindex="-1" aria-labelledby="exErrorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" style="color:#fff" id="exErrorLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{asset('images/error-icon.png')}}" alt="" class="exception-error">
                <span id="exErrorMessage"></span>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="termcondition" tabindex="-1" aria-labelledby="exErrorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" style="color:#fff" id="exErrorLabel"> Terms and Conditions</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span style="font-weight: 400;color: #0d0da2;font-style: italic;">I
                    do hereby
                    declare that all information and
                    documents are provided in complete manner. I confirm
                    that all the
                    information provided in the ‘Application Form’ and in
                    the other
                    documents is true, complete and correct. I agree that in
                    the event
                    of any particular information given being found false or
                    incorrect
                    or any discrepancy at any point of time, our application
                    is liable
                    to be rejected or cancelled or liable to be terminated
                    and the Solar
                    Photovoltaic (PV) Module Model shall be removed from the
                    List, if
                    enlisted, without any prior notice by MNRE. I
                    unconditionally agree
                    to comply with all the requirements, terms and
                    conditions stipulated
                    by MNRE. I also undertake to provide to MNRE, even after
                    enlistment,
                    any additional information, that is subsequently added
                    to this
                    Standard Application Format, by MNRE or any other
                    agency/
                    organisations, authorised by MNRE to do so.</span>
            </div>

        </div>
    </div>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" id="changePasswordBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordForced">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="changePasswordForced" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{URL::to('/users/forced-password-change')}}" method="POST" id="formAjax">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">New Password: <i style="color:red">*</i></label>
                        <input type="password" name="newpassword" id="newpassword" class="form-control" />
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ms-auto">
                        <label for="">Confirm Password: <i style="color:red">*</i></label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" />
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <input type="submit" id="submit1" class="btn btn-primary" value="Change Password">
        </div>
      </form>
      

    </div>
  </div>
</div>

<div class="modal fade" id="uploadPanGstData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{URL::to('/users/upload-pan-gst-document')}}" method="POST" id="formFileAjax">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Upload PAN & GST Documents</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Upload PAN Document <small class="text-primary">(PDF only)</small> : <i style="color:red">*</i></label>
                        <input type="file" name="pan_document" id="pan_document" class="form-control pdf_file_2mb" name="" id="">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ms-auto">
                        <label for="">Upload GST Document <small class="text-primary">(PDF only)</small> : <i style="color:red">*</i></label>
                        <input type="file" name="gst_document" id="gst_document" class="form-control pdf_file_2mb" name="" id="">
                    </div>
                    <small class="text-danger" style="float:left !important">* The maximum file size allowed for upload is 2MB</small>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            
            <input type="submit" id="submit1" class="btn btn-primary" value="Upload">
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