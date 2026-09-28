<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/password-validation.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/adminlte.min.js')}}"></script>
<script type="text/javascript">
var baseUrl = {
    !!json_encode(url('/')) !!
}
var validator = '';
</script>
<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('js/form_custom.js')}}"></script>
@stack('backend-js')
