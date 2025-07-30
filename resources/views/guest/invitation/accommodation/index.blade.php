@extends('layouts.guestinvitation')
@section('content')

<!-- .wed-host-section starts -->

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">
            <div>{{ucwords($invitation->slug)}}</div>
            <div class="row my-3 py-3 h3">

                <div class="col">Guest: {{$user->name}}</div>
                <div class="col">Host: {{$invitation->host->name}}</div>
            </div>
        </div>

        @if ($guest_accommodation >= 1)
        <table class="table table-sm table-hover table-striped">
            <thead class="bg-nav">

                <th>Relation</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Accommodation</th>

            <tbody>
                <tr>
                    <td>Self</td>
                    <td>{{$user->name}}</td>
                    <td>{{isset($user->profile->age) ? $user->profile->age : ''}}</td>
                    <td>{{isset($user->profile->gender) ?   ucfirst($user->profile->gender) : ''}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>
                        <form action="{{route('guestprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <label class="checkbox {{  $guest_accommodation > 1 ? 'accommodation' : 'No accommodation' }}" for="accommodation">
                                <input type="checkbox" name="accommodation" id="accommodation" {{ $guest_accommodation > 1 ? 'checked' : ''}} onclick="submit()">
                                {{ $guest_accommodation > 1 ? 'Accommodation' : 'No Accommodation'}}
                            </label>
                        </form>


                    </td>
                </tr>

                @foreach($user->family as $member)
                <tr>
                    <td>{{$member->familyrelation}}</td>
                    <td>{{$member->familyname}}</td>
                    <td>{{$member->familyage}}</td>
                    <td>{{ucwords($member->familygender)}}</td>
                    <td>{{$member->familymobile}}</td>
                    <td>

                        @if($member->privileges->isNotEmpty())
                        @foreach($member->privileges as $privilege)

                        <form action="{{route('guestfamilyprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <input hidden type="text" name="family_id" value="{{$member->id}}">
                            <label class="checkbox" for="attending">

                                @if($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 1)

                                <input type="checkbox" name="attending" 
                                id="attending" disabled  {{$privilege->attending == 1 ? 'checked' : ''}} onclick="submit()">
                                
                                @elseif($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 2)

                                <input type="checkbox" name="attending" id="attending" {{$member->familyrelation != "Wife" ? 'disabled' : ''}}   {{$privilege->attending == 1 ? 'checked' : ''}} onclick="submit()">

                                @else

                                <input type="checkbox" name="attending" id="attending"  {{$privilege->attending == 1 ? 'checked' : ''}} onclick="submit()">

                                @endif

                                {{ $privilege->attending == 1 ? 'Attending' : 'Not Attending'}}
                            </label>
                        </form>
                        @endforeach
                        @else
                        <form action="{{route('guestfamilyprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <input hidden type="text" name="family_id" value="{{$member->id}}">
                            <label class="checkbox" for="attending">

                                @if($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 1)


                                <input type="checkbox" name="attending" id="attending" disabled onclick="submit()">

                                @elseif($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 2)

                                <input type="checkbox" name="attending" id="attending" {{$member->familyrelation != "Wife" ? 'disabled' : ''}}  onclick="submit()">

                                @else

                                <input type="checkbox" name="attending" id="attending"   onclick="submit()">

                                @endif

                                Not Attending
                            </label>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(isset($guestaccomo) && $guest_accommodation >= 2)
        <table class="table table-sm table-hover table-striped">
            <thead class="bg-nav">

                <th colspan="2">Name</th>
                <th>HotelName</th>
                <th>Block</th>
                <th>Level</th>
                <th>Room No</th>

            <tbody>
                <tr>
                    <td colspan="2">{{$user->name}}</td>
                    <td>{{isset($guestaccomo[0]->hotelName) ? $guestaccomo[0]->hotelName : $guestaccomo->hotelName}}</td>
                    <td>{{isset($guestaccomo[0]->block) ? $guestaccomo[0]->block : $guestaccomo->block}}</td>
                    <td>{{isset($guestaccomo[0]->floor) ? $guestaccomo[0]->floor : $guestaccomo->floor}}</td>
                    <td>{{isset($guestaccomo[0]->roomno) ? $guestaccomo[0]->roomno : $guestaccomo->roomno}}</td>
                </tr>
                @forelse($user->family as $member)
                @forelse( $member->privileges as $privilege )

                <tr>
                    <td colspan="2">{{$member->familyname}}</td>
                    <td>{{isset($privilege->hotelName) ? $privilege->hotelName : ''}}</td>
                    <td>{{$privilege->block}}</td>
                    <td>{{$privilege->floor}}</td>
                    <td>{{$privilege->roomno}}</td>
                </tr>
                @empty
                @endforelse
                @empty
                @endforelse
            </tbody>
        </table>
        @endif
        @else
        <p class="h3 text-center text-danger"> Call <small>{{ucwords($invitation->host->name)}} </small>at <small>{{$invitation->host->mobile}}</small> to avail logistics/transport facility at the place</p>
        @endif
    </div>
    <!-- .wed-host-section-container ends -->

</div>

@endsection
