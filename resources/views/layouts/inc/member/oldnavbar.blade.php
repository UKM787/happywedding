 <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#461952;">
     <div class="container-fluid">
         <a class="navbar-brand text-white" href="{{ url('/') }}">
             {{ config('app.name', 'Laravel') }}
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- Left Side Of Navbar -->
             <ul class="navbar-nav mr-auto">
                 <a href="{{route('memberwelcome', ['host' => auth()->guard('host')->user()])}}">Member Dashboard </a>
             </ul>

             <!-- Right Side Of Navbar -->
             <ul class="navbar-nav ml-auto">
                 <!-- Authentication Links -->
                 <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                         Hi {{$member->name}} <span class="caret"></span>
                     </a>

                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="{{ route('logoutHost') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logoutHost') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
