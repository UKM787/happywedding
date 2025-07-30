 @include('layouts.inc.member.header')
 @include('layouts.inc.member.navbar')
 <div id="app">
   @if(Session::has('status'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     {{ Session::get('message') }}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   @endif
   <main>
     <div class="container  py-4">
       @yield('content')
     </div>
   </main>
   <landing-footer></landing-footer>
 </div>
 @include('layouts.inc.member.footer')
