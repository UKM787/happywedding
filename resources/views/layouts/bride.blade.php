 @include('layouts.inc.bride.header')
 @include('layouts.inc.bride.navbar')
 <div id="app">

     <main class="container">
         @if(Session::has('status'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             {{ Session::get('message') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         @endif

         @yield('content')
         <!-- <flash message="{{session('flash')}}"></flash> -->
     </main>
     <landing-footer></landing-footer>
 </div>
 @include('layouts.inc.bride.footer')
