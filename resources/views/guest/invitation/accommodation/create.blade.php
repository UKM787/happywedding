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
        <table class="table table-sm table-hover table-striped">
            <thead class="bg-nav">

                <th>Relation</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Accomodation</th>

            <tbody>
                <tr>
                    <td>Self</td>
                    <td>{{$user->name}}</td>
                    <td>{{isset($user->profile->age) ? $user->profile->age : ''}}</td>
                    <td>{{isset($user->profile->gender) ? $user->profile->gender : ''}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>
                        @foreach($user->invitation as $invi)
                        <form action="{{route('guestprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <label class="checkbox {{  $invi->pivot->accommodation > 1 ? 'Accomodation' : 'No Accomodation' }}" for="accommodation">
                                <input type="checkbox" name="accommodation" id="accommodation" {{ $invi->pivot->accommodation > 1 ? 'checked' : ''}} onclick="submit()">
                                {{ $invi->pivot->accommodation > 1 ? 'Accomodation' : 'noAccomodation'}}
                            </label>
                        </form>
                        @endforeach
                    </td>
                </tr>

                @foreach($user->family as $familymember)
                <tr>
                    <td>{{$familymember->relation}}</td>
                    <td>{{$familymember->name}}</td>
                    <td>{{$familymember->age}}</td>
                    <td>{{$familymember->gender}}</td>
                    <td>{{$familymember->mobile}}</td>
                    <td>

                        @if($familymember->privileges->isNotEmpty())
                        @foreach($familymember->privileges as $privilege)

                        <form action="{{route('guestfamilyprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <input hidden type="text" name="family_id" value="{{$familymember->id}}">
                            <label class="checkbox" for="attending">
                                <input type="checkbox" name="attending" id="attending" {{$privilege->attending == 9 ? 'checked' : ''}} onclick="submit()">
                                {{ $privilege->attending == 9 ? 'Attending' : 'Not Attending'}}
                            </label>
                        </form>
                        @endforeach
                        @else
                        <form action="{{route('guestfamilyprivilege.update',[$user,$invitation])}}" method="POST">
                            @csrf
                            <input hidden type="text" name="family_id" value="{{$familymember->id}}">
                            <label class="checkbox" for="attending">
                                <input type="checkbox" name="attending" id="attending" onclick="submit()">
                                NotAttending
                            </label>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- .wed-host-section-container ends -->

</div>

@endsection
