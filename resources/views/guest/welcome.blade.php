 @extends('layouts.guest')

 @section('content')

 <guest-home :user="{{$user}}" :invitations="{{$invitations}}" :invite-accepted="{{$inviteAccepted}}" :invite-rejected="{{$inviteRejected}}" :invite-pending="{{$invitePending}}" :invite-new="{{$inviteNew}}" :notifications="{{$notifications}}" :events="{{$events ? $events : '[]' }}"></guest-home>
 {{--
 <div class="h3 my-4"> <i class="text-primary">Hello {{ucwords($user->name)}}!</i> <small>Welcome to Happywed</small></div>
 @include('guest.inc.guestsummary', ['notifications' => $notifications])
 @include('guest.inc.guestselect' , ['notifications' => $notifications])
--}}
 @endsection
