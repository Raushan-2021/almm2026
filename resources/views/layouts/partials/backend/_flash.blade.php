@if (session('status'))
    <div id="successmsg" class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div id="failmsg" class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<script>
	window.setTimeout(function() {
	    $("#successmsg, #failmsg").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, 2000);
</script>