 <div class="bg-white" id="sidebar-wrapper">
     <!-- <div class="sidebar-heading text-center py-4 text-white fs-4 fw-bold text-uppercase border-bottom"><i class="fa fa-user me-2"></i><a href="{{route('adminwelcome', $loggedIn)}}" class="text-white px-2">{{ $loggedIn->name }}</a></div> -->
     <div class="list-group list-group-flush my-3">
         <a href="{{route('adminwelcome')}}" class="sidebar-heading py-4 text-white fs-6 fw-bold text-uppercase border-bottom nav-link"><i class="fas fa-tachometer-alt"></i> {{__(' Happywed')}}</a>
         <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>Super Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>Zone Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>State Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>City Admin</a> -->
         @if($loggedIn->role == 'admin')
         <div class="btn-group">
             <button type="button" class="list-group-item list-group-item-action bg-transparent text-white fw-bold" data-bs-toggle="dropdown"><i class="fa fa-paperclip me-2"></i>Masters</button>
             <ul class="dropdown-menu" style="width:100%">
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('adminlocation.index')}}"><i class="fa fa-map-marker me-2"></i>Locations</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('admincategory.index')}}"><i class="fa fa-shopping-cart me-2"></i>Vendors</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('adminservice.index')}}"><i class="fa fa-shopping-cart me-2"></i>Services</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('admintask.index')}}"><i class="fa fa-tasks me-2" aria-hidden="true"></i>Tasks</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('adminceramony.index')}}"><i class="fa fa-gift me-2"></i>Ceramonies</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('admintag.index')}}"><i class="fa fa-gift me-2"></i>tags</a></li>
                 <li>
                     <hr class="dropdown-divider">
                 </li>

             </ul>
         </div>
         <div class="btn-group">
             <button type="button" class="list-group-item list-group-item-action bg-transparent text-white fw-bold" data-bs-toggle="dropdown"><i class="fa fa-gift me-2"></i>Providers</button>
             <span class="visually-hidden">Toggle Dropdown</span>
             </button>
             <ul class="dropdown-menu" style="width:100%">
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('adminvenues.index')}}"><i class="fas fa-venus-double"></i>
                         Venues</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="{{route('adminaccommodation.index')}}"><i class="fas fa-bed"></i> Accommodation</a></li>
                 <li><a class="dropdown-item bg-transparent fw-bold" href="#"><i class="fas fa-bed"></i> Transport</a></li>
                 <li>
                     <hr class="dropdown-divider">
                 </li>
             </ul>
         </div>
         <div class="btn-group">
             <button type="button" class="list-group-item list-group-item-action bg-transparent text-white fw-bold" data-bs-toggle="dropdown"><i class="fa fa-gift me-2"></i>Marketing</button>
             <span class="visually-hidden">Toggle Dropdown</span>
             </button>
             <ul class="dropdown-menu" style="width:100%">
                 <li><a class="dropdown-item" href="{{route('admintestimonials.index')}}"><i class="fas fa-bed"></i>Testimonials</a></li>
                 <li>
                     <hr class="dropdown-divider">
                 </li>
                 <li><a class="dropdown-item" href="{{route('adminarticles.index')}}"><i class="fas fa-bed"></i>Idea & Inspiration</a></li>
             </ul>
         </div>
         <div class="btn-group">
             <button type="button" class="list-group-item list-group-item-action bg-transparent text-white fw-bold" data-bs-toggle="dropdown"><i class="fa fa-gift me-2"></i>Misc</button>
             <span class="visually-hidden">Toggle Dropdown</span>
             </button>
             <ul class="dropdown-menu" style="width:100%">
                 <li>
                     <hr class="dropdown-divider">
                 </li>
                 <li><a class="dropdown-item list-group-item-action bg-transparent second-text fw-bold" href="#"><i class="fa fa-comment me-2"></i>Chat</a></li>
             </ul>
         </div>
         @endif
         @if($loggedIn->role == 'blogger')
         <a href="{{route('admintestimonials.index')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-gift me-2"></i>Testimonials</a>
         <a href="{{route('adminarticles.index')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-gift me-2"></i>Idea & Inspiration</a>
         <a href="{{route('adminvenues.index')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-venus-double"></i>
             Wedding Venues</a>
         @endif
         <a class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off me-2"></i> {{ __('Logout') }} </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
     </div>
 </div>