 <div class="bg-white" id="sidebar-wrapper">
     <div class="sidebar-heading text-center py-4 text-white fs-4 fw-bold text-uppercase border-bottom"><i class="fa fa-user me-2"></i><a href="{{route('weddingvendorwelcome', $vendor)}}" class="text-white px-2">{{ $vendor->name }}</a></div>
     <div class="list-group list-group-flush my-3">
         <a href="{{route('weddingvendorwelcome', $vendor)}}" class="list-group-item list-group-item-action bg-transparent text-white fw-bold active"><i class="fas fa-tachometer-alt"></i> {{ __(' Dashboard') }}</a>
         <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>Super Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>Zone Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>State Admin</a>
         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-dashboard me-2"></i>City Admin</a> -->

         <a href="{{route('vendorservices.index', $vendor)}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-paperclip me-2"></i>Services</a>
         <a href="{{route('vendorleads.index', $vendor)}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-gift me-2"></i>Leads</a>
         <a href="{{route('vendorreviews.index', $vendor)}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-gift me-2"></i>Reviews</a>
         <a href="{{route('weddingvendorwelcome', $vendor)}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-map-marker me-2"></i>Tasks</a>


         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa fa-comment me-2"></i>Chat</a>

         <a class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off me-2"></i> {{ __('Logout') }} </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>

     </div>
 </div>
