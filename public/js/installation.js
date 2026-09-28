$(document).ready(function () {
    validator = $('#installationForm').validate();
    $(".datepicker").datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        orientation: "bottom",
    });

    $('#toilet_status').change(function () {
        if ($(this).val() == '1') {
            $('#toiletLinkedPhoto').removeClass('hidden');
            $('#linked_toilet_photo').addClass('required');
        }
        else $('#toiletLinkedPhoto').addClass('hidden');
    });
});

let setSubDistrictByVillage = (village, subDistrictSelectBox, subDistrict) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchSubDistrictsByVillage/' + village).then((resp) => {
        setDropdownHtml(resp, subDistrictSelectBox);
        $('#' + subDistrictSelectBox).val(subDistrict);
    });
}

let setDistrictBySubDistrict = (subDistrict, districtSelectBox, district) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchDistrictBySubDiscrict/' + subDistrict).then((resp) => {
        setDropdownHtml(resp, districtSelectBox);
        $('#' + districtSelectBox).val(district);
    });
}

let setStateByDistrict = (district, stateSelectBox, state) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchStateByDiscrict/' + district).then((resp) => {
        setDropdownHtml(resp, stateSelectBox);
        $('#' + stateSelectBox).val(state);
    });
}

let approveSystem = (url) => {
    $("#systemApproveModal #approveLink").attr('href', url);
    $("#systemApproveModal").modal('show');
}

let sendModificationRequest = () => {
    $('#installationForm').validate()
    if ($('#installationForm').valid()) {
        $('#installationForm').submit();
    }
}

$('#approval').change(function () {
    if ($(this).val() == '0')
        $('#correctionDiv').show();
    else
        $('#correctionDiv').hide();
});
