<div class="rk-user-details">
    {{ Auth::user()->name }}
    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
</div>
