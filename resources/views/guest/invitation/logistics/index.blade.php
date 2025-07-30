@extends('layouts.guestinvitation')
@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">
            <div>{{ucwords($invitation->slug)}}</div>
            <div class="row my-3 py-3 h3">

                <div class="col">Guest: {{$user->name}}</div>
                <div class="col">Host: {{$invitation->host->name}}</div>
            </div>
        </div>

        @if($guest_logistics >= 1 )
            <table class="table table-sm table-hover table-striped">
                <thead class="bg-nav">

                    <th>Relation</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Logistics</th>

                <tbody>
                    <tr>
                        <td>Self</td>
                        <td>{{$user->name}}</td>
                        <td>{{isset($user->profile->age) ? $user->profile->age : ''}}</td>
                        <td>{{isset($user->profile->gender) ? ucfirst($user->profile->gender) : ''}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>


                            <form action="{{route('guestlogistics.privilege',[$user,$invitation])}}" method="POST">
                                @csrf
                                <label class="checkbox {{  $guest_logistics >= 2 ? 'logisticsRequired' : 'notRequired' }}" for="logistics">
                                    <input type="checkbox" name="logistics" id="logistics" {{ $guest_logistics >= 2 ? 'checked' : ''}} onclick="submit()">
                                    {{ $guest_logistics >= 2 ? 'Logistics Required' : 'Not Required'}}
                                </label>
                            </form>

                        </td>
                    </tr>

                    @foreach($user->family as $familymember)
                    <tr>
                        <td>{{$familymember->familyrelation}}</td>
                        <td>{{$familymember->familyname}}</td>
                        <td>{{$familymember->familyage}}</td>
                        <td>{{ucwords($familymember->familygender)}}</td>
                        <td>{{$familymember->familymobile}}</td>

                        <td>
                            @if($familymember->privileges->isNotEmpty())

                            @foreach($familymember->privileges as $privilege)
                            <form action="{{route('guestlogistics.familyprivilege',[$user,$invitation])}}" method="POST">
                                @csrf
                                <input hidden type="text" name="family_id" value="{{$familymember->id}}">
                                <label class="checkbox" for="attending">
                                    @if($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 1)

                                    <input type="checkbox" name="attending" id="attending" disabled  {{$privilege->attending >= 1 ? 'checked' : ''}} onclick="submit()">

                                    @elseif($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 2)

                                    <input type="checkbox" name="attending" id="attending" {{$familymember->familyrelation != "Wife" ? 'disabled' : ''}}   {{$privilege->attending >= 1 ? 'checked' : ''}} onclick="submit()">
                                    

                                    @else

                                    <input type="checkbox" name="attending" id="attending"  {{$privilege->attending >= 1 ? 'checked' : ''}} onclick="submit()">

                                    @endif

                                    {{ $privilege->attending >= 1 ? 'Attending' : 'Not Attending'}}
                                    
                                </label>
                            </form>
                            @endforeach
                            @else

                            <form action="{{route('guestlogistics.familyprivilege',[$user,$invitation])}}" method="POST">
                                @csrf
                                <input hidden type="text" name="family_id" value="{{$familymember->id}}">
                                <label class="checkbox" for="attending">
                                    @if($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 1)
                                    
                                    <input type="checkbox" name="attending" id="attending" disabled onclick="submit()">

                                    @elseif($user->invitations->where('id', $invitation->id)->first()->guest_invitation->invite == 2)

                                    <input type="checkbox" name="attending" id="attending" {{$familymember->familyrelation != "Wife" ? 'disabled' : ''}}  onclick="submit()">

                                    @else

                                    <input type="checkbox" name="attending" id="attending"   onclick="submit()">

                                    @endif


                                    NotAttending
                                </label>
                            </form>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($guest_logistics >= 2 )
                <!-- .row starts -->
                <div class="row justify-content-center mb-3">
                    <div class="col-sm-6">
                        <!-- .col-sm-6 starts -->
                        <form method="POST" action="{{route('guestlogistics.arrival',[$user, $invitation ])}}">
                            @csrf
                            @include('guest.invitation.logistics.partials._arrival', ['arrival' => $arrival])
                        </form>
                        <!-- form submit ends -->
                    </div>
                    <!-- .col-sm-6 ends -->
                    <!-- .col-sm-6 starts -->
                    <div class="col-sm-6">
                        <form method="POST" action="{{route('guestlogistics.departure',[$user, $invitation ])}}">
                            @csrf
                            @include('guest.invitation.logistics.partials._departure', ['departure' => $departure])

                        </form>
                        <!-- form submit ends -->
                    </div>
                    <!-- .col-sm-6 ends -->
                </div>
                <!-- .row ends -->
                @if($arrival->vehicleNo != '')
                    <table class="table table-sm table-striped table-hover">
                        <thead class="bg-nav">
                            <tr class="bg-primary text-center">
                                <th colspan="3"> Arrival Details</th>
                            </tr>
                            <tr>
                                <th>Vehicle No</th>
                                <th>Incharge Name</th>
                                <th>Incharge Mo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$arrival->vehicleNo}}</td>
                                <td>{{$arrival->driverName}}</td>
                                <td>{{$arrival->driverMobile}}</td>
                            </tr>
                            <tr class="bg-info">
                                <td>Supervisor Name</td>
                                <td>Supervisor Mobile</td>
                                <td>SupervisorLocation</td>
                            </tr>
                            <tr>
                                <td>{{$arrival->inchargeName}}</td>
                                <td>{{$arrival->inchargeMobile}}</td>
                                <td>{{$arrival->inchargeLocation}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                @if($departure->vehicleNo != '' )
                    <table class="table table-sm table-striped table-hover">
                        <tr class="bg-primary text-center">
                            <th colspan="3"> Departure Details</th>
                        </tr>
                        <tr>
                            <th>Vehicle No</th>
                            <th>Incharge Name</th>
                            <th>Incharge Mo</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>{{$departure->vehicleNo}}</td>
                                <td>{{$departure->driverName}}</td>
                                <td>{{$departure->driverMobile}}</td>
                            </tr>
                            <tr class="bg-info">
                                <td>Supervisor Name</td>
                                <td>Supervisor Mobile</td>
                                <td>SupervisorLocation</td>
                            </tr>
                            <tr>
                                <td>{{$departure->inchargeName}}</td>
                                <td>{{$departure->inchargeMobile}}</td>
                                <td>{{$departure->inchargeLocation}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            @endif
        @else
        <p class="h3 text-center text-danger"> Call <small>{{ucwords($invitation->host->name)}} </small>at <small>{{$invitation->host->mobile}}</small> to avail logistics/transport facility at the place</p>
        @endif
      
    </div>
    <!-- .wed-host-section-container ends -->

</div>
<!-- .wed-host-section ends -->

@endsection
