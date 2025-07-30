 @extends('layouts.app')

 @section('content')
 <div class="container">
   <h1>Happy Wed Main Page</h1>
   <div class="row justify-content-center">
     <div class="col-md-8">
       <div class="card">
         <div class="card-header bg-nav text-white text-center h4">{{ __('Dashboard') }}</div>

         <div class="card-body">
           @if (session('status'))
           <div class="alert alert-success" role="alert">
             {{ session('success') }}
           </div>
           @endif

           {{ __('You are logged in! as guest') }}
         </div>
       </div>
     </div>
   </div>
 </div>


 @endsection
