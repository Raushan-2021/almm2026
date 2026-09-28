function responseMsg(res, msg) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    Toast.fire({
        icon: res,
        title: msg
    })
}
$(function () {
    $("#formAjax").on("submit", function (e) { //id of form
        //alert('hi');
        e.preventDefault();
        var action = $(this).attr("action"); //get submit action from form
        var method = $(this).attr("method"); // get submit method
        var form_data = new FormData($(this)[0]); // convert form into formdata
        var form = $(this);
        var submitText = $('#submit').html();
        //$('#submit').html('Please Wait...');
        $("#submit").attr("disabled", true);
        $('#loading-bg-ajax').removeClass('hide');
        $('#password').val('');
        $('.valid_error').html('');
        $.ajax({
            url: action,
            //dataType: 'json', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: method,
            complete: function (data) {
                //$('#submit').html(submitText);
                //$("#submit").attr("disabled", false);
                $('#loading-bg-ajax').addClass('hide');
            },
            success: function (response) {
                console.log(response);
               $('.text-danger').html('');
                $('#password').val('');

                if (response.status == 'verror') {
                    $('#loading-bg-ajax').addClass('hide');
                    regenerateToken();
                    responseMsg('error', 'Error!! Please fill all required fields');
                    printErrorMsg(response.data);
                    $("#submit").attr("disabled", false);
                } else if (response.status == 'ExError') {
                    ExceptionError(response.message)
                    //printErrorMsg (response.data);
                } else {
                    if (response.status == 'check') {
                        console.log(response.message);
                        return false;
                    }
                    if (response.url == '') {
                        responseMsg(response.status, response.message);
                        $('.text-danger').html('');
                        return false;

                    }
                    if (response.url != 'no' && response.url != 'undefined') {
                        //$('#submit').html('Please Wait...');
                        $('#submit').text('Processing …');
                        $("#submit").attr("disabled", true);
                        responseMsg(response.status, response.message);
                        setInterval(function () {
                            $('#submit').text('Redirecting Please Wait...');
                            //window.location = decodeURIComponent(response.url);

                            window.location.href = baseUrl + decodeURIComponent(response.url);
                        }, 2000);
                    } 
                } 
                // display success response from the server
            },
            error: function (response) { // handle the error

            },
        })
    });
});

$(function () {
    $("#formFileAjax").on("submit", function (e) { //id of form
        e.preventDefault();
        $('span.validation-error').remove();
        var action = $(this).attr("action"); //get submit action from form
        var method = $(this).attr("method"); // get submit method
        var form_data = new FormData($(this)[0]); // convert form into formdata
        var form = $(this);
        var submitText = $('#submit').html();
        $("#submit").attr("disabled", true);
        //$('#submit').html('Please Wait...');

        $('#loading-bg-ajax').removeClass('hide');
        $.ajax({
            url: action,
            //dataType: 'json', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: method,
            complete: function (data) {
                //$('#loading-bg-ajax').addClass('hide');
            },
            beforeSend: function () {
                // $(".progress-bar").width('0%');
                $('#uploadStatus').html('Uploading....');
            },
            success: function (response) {
                //alert(response);
                if (response.status == 'verror') {
                    $('#loading-bg-ajax').addClass('hide');
                    regenerateToken();
                    responseMsg('error', 'Error!! Please fill all required fields');
                    printErrorMsg(response.data);
                    $("#submit").attr("disabled", false);
                } else if (response.status == 'ExError') {
                    ExceptionError(response.message);
                    //printErrorMsg (response.data);
                } else {
                    if (response.status == 'sandes') {
                        responseMsg(response.status, response.message);
                        $('#error-msg').html(response.data);
                        $('#submit').hide();
                        $('#reset').show();
                        $('#view_status').show();
                        return false;

                    } else if (response.status == 'success') {
                        $('#submit').text('Processing …');
                        $("#submit").attr("disabled", true);
                        responseMsg(response.status, response.message);
                        $('#loading-bg-ajax').addClass('hide');
                        if (response.url != 'no' && response.url != 'undefined') {
                            setInterval(function () {

                                if (response.url != '' && response.url != 'undefined') { //Redirect to URL return from controller
                                    var url = decodeURIComponent(response.url);
                                    window.location.href = baseUrl + url;
                                } else {
                                    location.reload();
                                }
                            }, 2000);
                        }
                    } else if (response.status) {
                        responseMsg(response.status, response.message);
                        $('#valid-error-form').html('');

                    }
                }
                // display success response from the server
            },
            error: function (response) { // handle the error
                regenerateToken();
                $('#submit').html(submitText);
                $("#submit").attr("disabled", false);

            },

        })
    });
});

function ExceptionError(msg) {
    $('#loading-bg-ajax').addClass('hide');
    $('#ExErrorModal').modal('show');
    regenerateToken();
    var splitResponseByDelimeter = msg.split('||');
    $('#exErrorLabel').html('Error Code : ' + splitResponseByDelimeter[0]);
    $('#exErrorMessage').html(splitResponseByDelimeter[1]);
    $("#submit").attr("disabled", false);
}
function printErrorMsg(msg) {
    $('span.validation-error').remove();
    $.each(msg, function (key, value) {

        $("[name='" + key + "']").after("<span class='validation-error' id='valid-error-form'  style='color:red;'>" + value + "</span>");
        $("[name='" + key + "']").addClass('is-invalid');
        //$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}
function regenerateToken() {
    $.ajax({
        url: baseUrl + "/ajax/ajax-refresh-csrf",
        type: 'get',
        dataType: 'json',
        success: function (result) {
            $('meta[name="csrf-token"]').attr('content', result.token);
            $("input[name='_token']").val(result.token);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': result.token
                }
            });
        },
        error: function (xhr, status, error) {
            //console.log(xhr);
        }
    });
}

