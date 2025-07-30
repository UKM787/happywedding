@include('layouts.inc.app.header')
@include('layouts.inc.app.navbar')


<main style="display:none">
    <div id="app">
        <landing-header></landing-header>
        <flash-message id="flash-custom-message" message="{{Session::get('message')}}"></flash-message>

        @yield('content')
        <landing-footer></landing-footer>
    </div>

</main>
@include('layouts.inc.app.footer')