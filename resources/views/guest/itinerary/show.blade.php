@extends('layouts.guest')
@section('content')

<div class="row">
<div class="col-md-12 p-2"> <a href="{{route('itinerary.edit', [$user,  $invitation, $itinerary])}}"  class="btn mr-2 bg-nav text-white">{{ucwords($user->name)}} Arrival <i class="material-icons" title="Edit Itinerary">edit</i></a></div>
<table class="table table-bordered">

  <thead class="bg-nav">
    <th>PickUp Required</th><th>Arrival Date</th><th>Arrival Time</th><th>Arrival Location</th><th>Mode of Travel</th><th>Family Members</th>
    </thead>
    <tbody>
      <tr>
        <td>{{$itinerary->pickup ? 'Yes' : 'No'}}</td>
        <td>{{$itinerary->date}}</td>
        <td>{{$itinerary->arr_time}}</td>
        <td>{{$itinerary->location}}</td>
        <td>{{$itinerary->arr_travelMode}}</td>
        <td>{{$itinerary->arr_familyMembers}}</td>
      </tr>
    </tbody>
</table>

<div class="col-md-12 p-2"> <a href="#" class="btn mr-2 bg-nav text-white">{{ucwords($user->name)}} Departure <i class="material-icons" title="Edit Itinerary">edit</i></a></div>
<table class="table table-bordered">
  <thead class="bg-nav">
    <th>Dropdowm Required</th>
    <th>Departure Date</th>
    <th>Deaprture Time</th>
    <th>Departure Locations</th>
    <th>Mode of Travel</th>
    <th>Family Members</th>
  </thead>
  <tbody>
    <tr>
      <td>{{$itinerary->dropdown ? 'Yes' : 'No'}}</td>
      <td>{{$itinerary->date}}</td>
      <td>{{$itinerary->dep_time}}</td>
      <td>{{$itinerary->location}}</td>
      <td>{{$itinerary->dep_travelMode}}</td>
      <td>{{$itinerary->dep_familyMembers}}</td>
    </tr>
  </tbody>
</table>

</div>
@endsection
