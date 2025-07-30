@if(auth()->guard('admin')->check())
<p class="text-success">You are logged in as Admin</p>

@else
<p class="text-danger">You are logged out as Admin</p>
@endif

@if(auth()->guard('host')->check())
<p class="text-success">You are logged in as Host</p>

@else
<p class="text-danger">You are logged out as Host</p>
@endif
@if(auth()->guard('web')->check())
<p class="text-success">You are logged in as Guest</p>

@else
<p class="text-danger">You are logged out as Guest</p>
@endif

@if(auth()->guard('company')->check())
<p class="text-success">You are logged in as Wedding Planner</p>

@else
<p class="text-danger">You are logged out as Wedding Planner</p>
@endif

@if(auth()->guard('vendor')->check())
<p class="text-success">You are logged in as Vendor</p>

@else
<p class="text-danger">You are logged out as Vendor</p>
@endif
