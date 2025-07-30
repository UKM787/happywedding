 @include('layouts.inc.guest.invitation.header')
 @include('layouts.inc.guest.invitation.navbar')

 <div id="app">
     <main>
         @if(Session::has('status'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             {{ Session::get('message') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
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


 @include('layouts.inc.guest.invitation.footer')