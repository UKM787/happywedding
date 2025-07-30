@extends('layouts.host')

@section('content')
<host-reports :host="{{$host}}" :guests="{{$guests}}"></host-reports>
{{--
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title">
            <h1> Total Invitations</h1>
            <h4> Contact Info : {{strtoupper($host->name)}} - <span class="small text-success">{{$host->mobile}} - {{$host->email}}</span></h4>
        </div>


        @if (! is_null($guests) )
        <table class="table table-striped table-hover">
            <thead class="bg-info">
                <th class="h4 text-white px-2">Guest Name</th>
                <th class="h4 text-white px-2">Guest Mobile</th>
                <th class="h4 text-white px-2">Guest Email</th>
                <th class="h4 text-white px-2">Invite</th>
                <th class="h4 text-white px-2">Status</th>
                <th class="h4 text-white px-2">Accomodation</th>
                <th class="h4 text-white px-2">Logistics</th>
            </thead>
            <tbody>
                @foreach($guests as $guest)

                <tr>
                    <td class="p-2 text-muted">{{$guest->name}}</td>
                    <td class="p-2 text-muted"> {{$guest->mobile}}</td>
                    <td class="p-2 text-muted">{{$guest->email}}</td>
                    <td class="p-2 text-muted">{{ $guest->pivot->invite == 0 ? 'No Invitation' : ( $guest->pivot->invite == 1 ? 'Single' : ($guest->pivot->invite == 2 ? 'Spouse' : 'Family'))}}</td>
                    <td class="p-2 text-muted">{{ $guest->pivot->inviteStatus < 4 ? 'Not Seen' : ($guest->pivot->inviteStatus == 4 ? 'Pending' : ( $guest->pivot->inviteStatus == 5 ? 'Rejected' : 'Accepted'))}}</td>
                    <td class="p-2 text-muted">{{$guest->pivot->accommodation == 0 ? 'Not Offered' : ($guest->pivot->accommodation == 1 ? 'Offered' : ($guest->pivot->accommodation == 2 ? 'Accepted' : ($guest->pivot->accommodation == 3 ?'Accomodation Booked' : 'Not Booked')))}}</td>
                    <td class="p-2 text-muted">{{$guest->pivot->logistics == 0 ? 'Not Offered' :($guest->pivot->logistics == 1 ? 'Offered' : ($guest->pivot->logistics == 2 ? 'Accepted' : ($guest->pivot->logistics == 3 ?'infoArrival Submitted' : ($guest->pivot->logistics == 4 ? 'infoDeparture Submitted' : ($guest->pivot->logistics == 5 ? ' Arrival Transport Booked' : ($guest->pivot->logistics == 6 ? '2way Transport Booked' : 'Not Booked'))))))}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-danger">No Guests Added yet</h3>
        @endif
    </div>
</div>
--}}

@endsection
