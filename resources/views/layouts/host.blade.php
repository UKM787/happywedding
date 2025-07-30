@include('layouts.inc.host.header')
{{--@include('layouts.inc.host.navbar')--}}

<div id="app">
    <host-header :logged-in="{{isset($host) ? $host : 'null'}}"></host-header>
    <host-nav link="{{$active ?? null}}" :invitation="{{isset($invitation) ? $invitation : 'null'}}"></host-nav>
    <main style="position:relative; top:182px; margin-bottom:220px" class="container-xl">
        <flash-message id="flash-custom-message" message="{{Session::get('message')}}"></flash-message>
        @yield('content')
    </main>
    {{--<landing-footer></landing-footer>--}}
</div>
@include('layouts.inc.host.footer')