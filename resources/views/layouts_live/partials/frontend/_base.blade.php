<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('js/base_forms_validation.js') }}"></script>
<script src="{{ URL::asset('js/password-validation.js') }}"></script>
<script src="{{ URL::asset('js/icheck.min.js') }}"></script>
<script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ URL::asset('js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.2/dist/Chart.min.js"></script>
<script type="text/javascript">
var baseUrl = {
    !!json_encode(url('/')) !!
}
var validator = '';
@if(Session::has('msg'))
$('#msgModal').modal('show');
@endif
</script>
<script src="{{ URL::asset('js/common.js') }}"></script>
