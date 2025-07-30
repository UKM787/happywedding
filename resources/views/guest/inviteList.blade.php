 @extends('layouts.guest')

 @section('content')

 <guest-invite-list :user="{{$user}}" :invitations="{{$invitations}}" active="{{$link}}"></guest-invite-list>
 @endsection
