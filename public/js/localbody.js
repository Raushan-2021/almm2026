$(document).ready(function () {
    $('#createLocalbodyForm').validate();

    // Upload Excel proccess
    $("#uploadExcelForm").on('submit', function (e) {
        e.preventDefault();
        var user = $("#UploadExcelModalButton").data('user');
        var url = '{{URL::to("/mnre/upload-excel")}}'
        uploadExcel(this, url, user);
    });

    $('#superior_agency_div').addClass('hidden');
    $('#agency_type').change(function () {
        if ($(this).val() == 'Local Body') {
            $('#superior_agency_div').removeClass('hidden');
            $('select[id="superior_agency"]').addClass('required');
        } else $('#superior_agency_div').addClass('hidden');
    });
});

let setDistrictBySubDistrict = (subDistrict, districtSelectBox, district) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchDistrictBySubDiscrict/' + subDistrict).then((resp) => {
        setDropdownHtml(resp, districtSelectBox);
        $('#' + districtSelectBox).val(district);
        $('#' + districtSelectBox).attr('disabled', true);
    });
}

let setStateByDistrict = (district, stateSelectBox, state) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchStateByDiscrict/' + district).then((resp) => {
        setDropdownHtml(resp, stateSelectBox);
        $('#' + stateSelectBox).val(state);
        $('#' + stateSelectBox).attr('disabled', true);
    });
}

