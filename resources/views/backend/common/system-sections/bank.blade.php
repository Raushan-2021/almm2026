<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="bank_name">{{ __('Bank Name') }} <span class="error">*</span></label>
            <input type="text" {{$editable ?? ''}} class="form-control required" name="bank_name" value="{{$installation->bank_name ?? ''}}" placeholder="Bank Name">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="branch_address">{{ __('Branch Address') }} <span class="error">*</span></label>
    <textarea class="form-control required" {{$editable ?? ''}} name="branch_address" rows="3" placeholder="Branch address...">{{$installation->branch_address ?? ''}}</textarea>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="account_no">{{ __('Account Number') }} <span class="error">*</span></label>
            <input type="text" {{$editable ?? ''}} class="form-control required number" name="account_no" value="{{$installation->account_no ?? ''}}" placeholder="Account Number">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="account_type">{{ __('Type of Bank Account') }} <span class="error">*</span></label>
            <select class="form-control required" name="account_type" {{$editable ?? ''}}>
                <option value="" selected disabled>Select Type of Bank Account</option>
                @foreach (Config::get('constants.bank_account_types') as $accountType)
                <option value="{{$accountType['code']}}" @if(($installation['account_type'] ?? '') == $accountType['code']) selected @endif>{{$accountType['name']}}</option>    
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="ifsc_code">{{ __('IFSC Code of Bank') }} <span class="error">*</span></label>
            <input type="text" {{$editable ?? ''}} class="form-control required" name="ifsc_code" value="{{$installation->ifsc_code ?? ''}}" placeholder="IFSC Code">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="branch_code">{{ __('Branch Code') }} <span class="error">*</span></label>
            <input type="text" {{$editable ?? ''}} class="form-control required" name="branch_code" value="{{$installation->branch_code ?? ''}}" placeholder="Branch Code">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="micr_code">{{ __('MICR Code') }} <span class="error">*</span></label>
            <input type="text" {{$editable ?? ''}} class="form-control required number" name="micr_code" value="{{$installation->micr_code ?? ''}}" placeholder="MICR Code">
        </div>
    </div>
    @if (Auth::getDefaultDriver() === 'installer')
    <div class="col-md-4">
        <div class="form-group">
            <label for="bank_passbook">{{ __('Photograph of the Passbook') }} <span class="error">*</span></label>
            <input type="file" class="form-control @if(empty($installation->bank_passbook)) required @endif" name="bank_passbook" {{$editable ?? ''}}>
            @if (!empty($installation->bank_passbook))
                @php $passbook = json_decode($installation->bank_passbook, true); @endphp
                <a class="" href="{{URL::to('/'.Auth::getDefaultDriver().'/preview-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'.$passbook['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to('/'.Auth::getDefaultDriver().'/download-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'.$passbook['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    @else
        <div class="col-md-12">
            <div class="form-group">
                <label for="bank_passbook">{{ __('Photograph of the Passbook') }} <span class="error">*</span></label>
                <div class="clearfix"></div>
                @if (!empty($installation->bank_passbook))
                    @php $passbook = json_decode($installation->bank_passbook, true); @endphp
                    <a class="" href="{{URL::to('/'.Auth::getDefaultDriver().'/preview-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'.$passbook['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                    <a class="ml-5 download-link" href="{{URL::to('/'.Auth::getDefaultDriver().'/download-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'.$passbook['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
                @else
                    <span><em>Document not uploaded</em></span>
                @endif
            </div>
        </div>
    @endif
</div>
