<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('js/password-validation.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/adminlte.min.js')}}"></script>
<script type="text/javascript" src="{{asset('sweetalert2/sweetalert2.min.js?202206071444')}}"></script>
<script type="text/javascript">
        var baseUrl = '{{URL::to("/")}}';
        var validator = '';
</script>
<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('js/form_custom.js')}}"></script>
<script>
/*$('.pdf_file').change(function() {
    var name = this.files[0].name;
    var a = (this.files[0].size);
    var fileType = this.files[0].type;
    //$("#budget_cost_details").val(this.files[0].name);
    if (a > 1000000) {
        alert('Maximum allowed size for file is "1MB" ');
        $('#' + this.id).val('').clone(true);
        return false;
    }

    var fileExtension = ['pdf'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 && fileType !=
        'application/pdf') {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }
    if (name.match(/\./g).length > 1) {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }

});
$('.pdf_file_2mb').change(function() {
    var name = this.files[0].name;
    var a = (this.files[0].size);
    var fileType = this.files[0].type;
    //$("#budget_cost_details").val(this.files[0].name);
    if (a > 2097152) {
        alert('Maximum allowed size for file is "2MB" ');
        $('#' + this.id).val('').clone(true);
        return false;
    }

    var fileExtension = ['pdf'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 && fileType !=
        'application/pdf') {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }
    if (name.match(/\./g).length > 1) {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }

});
$('.pdf_file_10mb').change(function() {
    var name = this.files[0].name;
    var a = (this.files[0].size);
    var fileType = this.files[0].type;
    //$("#budget_cost_details").val(this.files[0].name);
    if (a > 10000000) {
        alert('Maximum allowed size for file is "10MB" ');
        $('#' + this.id).val('').clone(true);
        return false;
    }

    var fileExtension = ['pdf'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 && fileType !=
        'application/pdf') {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }
    if (name.match(/\./g).length > 1) {
        alert('Invalid file. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }

});
$('.img_file').change(function() {
    var name = this.files[0].name;
    var a = (this.files[0].size);
    var fileType = this.files[0].type;
    //$("#budget_cost_details").val(this.files[0].name);
    if (a > 1000000) {
        alert('Maximum allowed size for file is "1MB" ');
        return false;
    }

    var fileExtension = ['jpg', 'png', 'jpeg'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 && fileType !=
        'application/pdf') {
        alert('Invalid Image. PNG, JPG, JPEG are allowed');
        $('#' + this.id).val('').clone(true);
        return false;
    }
    if (name.match(/\./g).length > 1) {
        alert('Invalid image. Please select valid one');
        $('#' + this.id).val('').clone(true);
        return false;
    }

});
*/



$(document).ready(function () {
    const validExtensions = ['.txt', '.jpg', '.png', '.pdf', '.xls', '.jpeg', '.xlsx', '.csv'];
    const validMimes = [
        'text/plain',
        'image/jpeg',
        'image/png',
        'application/pdf',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/csv',
        'application/csv'
    ];

    // Listen for change on ALL file inputs
    $(document).on('change', 'input[type="file"]', async function (event) {
        const files = event.target.files;
        const fileInput = $(this);

        for (let file of files) {
            const fileName = file.name;
            const lastDotIndex = fileName.lastIndexOf('.');

            // 1️⃣ No extension
            if (lastDotIndex === -1) {
                alert(`${fileName} has no extension and is invalid.`);
                fileInput.val('');
                return;
            }

            const baseName = fileName.substring(0, lastDotIndex);
            const fileExtension = fileName.substring(lastDotIndex).toLowerCase();

            // 2️⃣ Prevent multiple dots in filename
            if (baseName.includes('.')) {
                alert(`${fileName} has multiple extensions and is invalid.`);
                fileInput.val('');
                return;
            }

            // 3️⃣ Validate extension
            if (!validExtensions.includes(fileExtension)) {
                alert(`${fileName} has an invalid extension.`);
                fileInput.val('');
                return;
            }

            // 4️⃣ Validate MIME type
            if (!validMimes.includes(file.type)) {
                alert(`${fileName} has an invalid MIME type.`);
                fileInput.val('');
                return;
            }

            // 5️⃣ Header checks (PDF/JPG/PNG only)
            if (['.pdf', '.jpg', '.jpeg', '.png'].includes(fileExtension)) {
                const header = await readFileHeader(file, 4);

                if (fileExtension === '.pdf' && header !== '%PDF') {
                    alert(`${fileName} is not a real PDF file.`);
                    fileInput.val('');
                    return;
                }
                if ((fileExtension === '.jpg' || fileExtension === '.jpeg') && !isJpeg(header)) {
                    alert(`${fileName} is not a real JPG file.`);
                    fileInput.val('');
                    return;
                }
                if (fileExtension === '.png' && !isPng(header)) {
                    alert(`${fileName} is not a real PNG file.`);
                    fileInput.val('');
                    return;
                }
            }

            // CSV needs no binary signature check
        }

        console.log('✅ All selected files passed validation!');
    });

    // Helper: Read first bytes of a file
    async function readFileHeader(file, length) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            const blob = file.slice(0, length);
            reader.onloadend = () => {
                const arr = new Uint8Array(reader.result);
                let header = '';
                for (let i = 0; i < arr.length; i++) {
                    header += String.fromCharCode(arr[i]);
                }
                resolve(header);
            };
            reader.readAsArrayBuffer(blob);
        });
    }

    // Detect JPG
    function isJpeg(header) {
        const bytes = Array.from(header).map(ch => ch.charCodeAt(0));
        return bytes[0] === 0xFF && bytes[1] === 0xD8 && bytes[2] === 0xFF;
    }

    // Detect PNG
    function isPng(header) {
        return header.startsWith('\x89PNG');
    }
});








if (document.querySelector('.toggle-sidebar-btn')) {
    document.querySelector('.toggle-sidebar-btn').addEventListener('click', function(e) {
        document.body.classList.toggle('toggle-sidebar');
    });
}

</script>
@if(Auth::getDefaultDriver()=='users' && Auth::user()->is_password_change==0)
<script>
    $(window).on('load', function() {
        $('#changePasswordForced').modal('show');
    });
</script>
@endif

@if(Auth::user()->is_password_change==1 && (Auth::user()->pan_document=='' || Auth::user()->gst_document==''))
<script>
    $(window).on('load', function() {
        $('#uploadPanGstData').modal('show');
    });
</script>
@endif

<!-- validate script tag in input field validate by Raushan -->
<script>
$(document).ready(function() {

  $(document).on('focusout', 'input, textarea, select', function() {
      const fldname = $(this).attr('id');  
      if (fldname) {
        validate_script(fldname);
      }
  });

});

function validate_script(fldname) {
    const field = document.getElementById(fldname);
    if (!field) return;

    if (field.type === 'file') return;

    let value = field.value;

    // Alphanumeric + space + hyphen + colon + @ + dot allow
    const cleanedValue = value.replace(/[^a-zA-Z0-9\- :@.]/g, '');

    if (value !== cleanedValue) {
        alert('Only alphanumeric characters, spaces, hyphens, colons, @, and . are allowed!');
        field.value = cleanedValue;
    }
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("input").forEach(function(input){
        input.setAttribute("autocomplete", "off");
    });
});
</script>

@stack('backend-js')