@include('layouts.inc.guest.header')
@include('layouts.inc.guest.navbar')

<!-- Add Font Awesome if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div  id="app">
    <main class="py-4">
        @if(Session::has('status'))
        <flash-message id="flash-custom-message" message="{{Session::get('message')}}"></flash-message>
        
        @endif
        @if(Session::has('feedback'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @yield('content')
    </main>
    <landing-footer></landing-footer>
</div>


@include('layouts.inc.guest.footer')

