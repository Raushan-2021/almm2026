<div class="register-box-body">
    <!-- <p class="login-box-msg">Register a new membership</p> -->
    This user already logged in elsewhere. Logout on other devices first

    <a href="javascript:;" onclick="myFunction()" class="text-center">Click Here</a>
    <form method="POST" id="logoutForm" action="{{ route('logout') }}">
        @csrf
        {{-- <input type="hidden" name="usid" id="" value="{{ Auth::user()->id}}" /> --}}
    </form>
</div>
<script>
function myFunction() {
    document.getElementById("logoutForm").submit();
}
</script>