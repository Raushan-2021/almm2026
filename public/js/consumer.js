let setDistrictBySubDistrict = (subDistrict, districtSelectBox, district) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchDistrictBySubDiscrict/' + subDistrict).then((resp) => {
        setDropdownHtml(resp, districtSelectBox);
        $('#' + districtSelectBox).val(district);
        $('#' + districtSelectBox).attr('readonly', true);
    });
}

let setStateByDistrict = (district, stateSelectBox, state) => {
    ajaxcall('GET', {}, baseUrl + '/ajax/fetchStateByDiscrict/' + district).then((resp) => {
        setDropdownHtml(resp, stateSelectBox);
        $('#' + stateSelectBox).val(state);
        $('#' + stateSelectBox).attr('readonly', true);
    });
}
