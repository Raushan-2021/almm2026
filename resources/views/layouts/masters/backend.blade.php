<!DOCTYPE html>
<html>
@include('layouts.partials.backend._head')

<body>

    @include('layouts.partials.backend._header')
    @include('layouts.partials.backend._sidebar')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('title')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </nav>
        </div>


        <section class="section">
            @yield('content')
        </section>
    </main>
    @include('layouts.partials.backend._modals')
    @include('layouts.partials.modals.association')
    @include('layouts.partials.modals.systemApprove')
    @include('layouts.partials.backend._scripts')
    <script type="text/javascript" src="{{asset('js/crypto-js.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/aes.min.js')}}"></script>
    <div id="loading-bg-ajax" class="loading-bg-ajax hide">
        <div class="ajax-loader">
            <img src="{{ url('/public/backend/images/loader.gif') }}" class="img-responsive" style="width:35%" />
        </div>
    </div>
    <script>
    function createToken() {
        var token = makeid(20);
        $.ajax({
            type: "POST",
            url: "/ajax/generate-token/" + token,
            data: {
                "_token": "{{ csrf_token() }}",
                token: token,
            },
            processData: false,
            contentType: false,
            success: function(response) {
                $('#tk').html(token);
            },
        });

    }


    function validate_password(password)
{
 // alert(password);
 isvalid=hasConsecutiveNumbers(password);
  if(password.length < 8) { 


    alert("Error: Password must be at least 8 characters"); 
    $('#new_password').val('');

} 
else if(password.search(/[a-z]/) < 0) { 

  alert("Error: Password must contain at least one lowercase letter"); 
  $('#new_password').val('');

} 
else if(password.search(/[A-Z]/) < 0) { 
alert("Error: Password must contain at least one uppercase letter"); 
$('#new_password').val('');

} else if(password.search(/[0-9]/) < 0) { 

alert("Error: Password must contain at least one number"); 
$('#new_password').val('');

}
else if(hasConsecutiveNumbers(password) || hasConsecutiveLetters(password))
{
  alert("Error: Password  contain consecutive number or consecutive character"); 
$('#new_password').val('');
}
else { 

  //alert("Password"); 

} 
}

function hasConsecutiveNumbers(password) {
    const numberPattern = /012|123|234|345|456|567|678|789/;
    return numberPattern.test(password);
}
/*function hasConsecutiveNumbers(password) {
    let prevDigit = -1;  // Variable to store the previous digit
    
    for (let i = 0; i < password.length; i++) {
        const char = password[i];
        if (/\d/.test(char)) {  // Check if character is a digit
            const currentDigit = parseInt(char);
            if (prevDigit !== -1 && currentDigit === prevDigit + 1) {
                return true;
            }
            prevDigit = currentDigit;
        } else {
            prevDigit = -1;  // Reset if non-digit character is found
        }
    }
    return false;
}*/
function hasConsecutiveLetters(password) {
    // Convert password to lowercase to handle case insensitivity
    const lowerCasePassword = password.toLowerCase();
    
    // Check for consecutive letters (at least 3 consecutive letters)
    for (let i = 0; i < lowerCasePassword.length - 2; i++) {
        const charCode1 = lowerCasePassword.charCodeAt(i);
        const charCode2 = lowerCasePassword.charCodeAt(i + 1);
        const charCode3 = lowerCasePassword.charCodeAt(i + 2);
        
        // Check if three consecutive characters are consecutive letters
        if (charCode2 === charCode1 + 1 && charCode3 === charCode2 + 1) {
            return true;
        }
    }
    return false;
}


    document.querySelector('#changePasswordForm').addEventListener('submit', (e) => {
        e.preventDefault();

        var current_password = document.getElementById("current_password");
        var new_password = document.getElementById("new_password");
        var new_password_confirmation = document.getElementById("new_password_confirmation");
        var token = document.getElementById("tk").innerText;
        if (current_password.value == '') {
            alert('Please enter current password');
            return false;
        }
        if (new_password.value == '') {
            alert('Please enter new password');
            return false;
        }
        if (new_password_confirmation.value == '') {
            alert('Please enter confirm password');
            return false;
        }
        if(new_password.value!=new_password_confirmation.value)
        {

            alert('New Password and confirm password does not matched');
            return false;
        }
        new_password.value = new_password.value + '-' + token;
        new_password_confirmation.value = new_password_confirmation.value + '-' + token;
        current_password.value = current_password.value + '-' + token;
        //alert(pwd.value);
        var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
        var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");

        var encPwd = CryptoJS.AES.encrypt(current_password.value, key, {
            iv,
            padding: CryptoJS.pad.ZeroPadding,
        });
        var encNewPwd = CryptoJS.AES.encrypt(new_password.value, key, {
            iv,
            padding: CryptoJS.pad.ZeroPadding,
        });
        var encConfPwd = CryptoJS.AES.encrypt(new_password_confirmation.value, key, {
            iv,
            padding: CryptoJS.pad.ZeroPadding,
        });

        new_password_confirmation.value = encConfPwd.toString();
        new_password.value = encNewPwd.toString();
        current_password.value = encPwd.toString();
        var loginForm = document.getElementById("changePasswordForm");
        loginForm.submit();

    });

    function checknotification() {
        $.ajax({
            url: "{{url(Auth::getDefaultDriver().'/fetch-notification-By-Id')}}",
            type: "GET",
            // data: {
            //     "_token": "{{ csrf_token() }}",
            // },
            success: function(response) {
                var data = '';
                if (response.data != '') {
                    $.each(response.data, function(key, value) {

                        data +=
                            '<li> <a class="dropdown-item d-flex align-items-center" href=""> <span> <i style="font-size:15px;" class="text-primary">' +
                            value.from_user_type.toUpperCase() + ' :</i>' +
                            value.notification +
                            '</span> </a> <span class="time">' + value.updated_at +
                            ' </span></li> <li> <hr class="dropdown-divider"> </li > ';

                    });
                    $('#notificationData').html(data);
                } else {
                    $('#notificationData').html('No new notification found.');
                }
                $('#notificationCount').html(response.count);

            },
            error: function(response) {
                //alert(response.error);
                //$('#name-error').text(response.responseJSON.errors.name);
            }
        });
    }
    $(document).ready(function() {
        checknotification();
        setInterval(function() {
            //checknotification();
        }, 10000);


    });
    </script>
    <style>
    .loading-bg-ajax {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        overflow: hidden;
        z-index: 99999;
        background-color: #000000;
        opacity: .5;
    }

    .ajax-loader {
        position: absolute;
        z-index: 9999999999;
        top: 30%;
        left: 52%;
    }

    .hide {
        display: none;
    }
    </style>
</body>

</html>