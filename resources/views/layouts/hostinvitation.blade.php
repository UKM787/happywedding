@include('layouts.inc.host.invitation.header')
{{--@include('layouts.inc.host.invitation.navbar')--}}



<div id="app">
    <host-header :logged-in="{{isset($host) ? $host : 'null'}}"></host-header>
    <invi-nav :invitation="{{isset($invitation) ? $invitation : 'null'}}" link="{{$active ?? null}}"></invi-nav>
    <main style="position:relative; top:155px; margin-bottom:220px; min-height:90vh">
        @if(Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @yield('content')
    </main>
    {{--<landing-footer></landing-footer>--}}s
</div>


@include('layouts.inc.host.invitation.footer')
