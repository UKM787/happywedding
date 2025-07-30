@extends('layouts.host')

@section('content')

<div class="container overflow-hidden">
  <a href="{{route('hostinvitations.create', $host)}}" class="btn bg-nav text-white h4" title="create wedding invitation"><i class="material-icons p-2">&#xE147</i></a>
  <div class="row gy-5">
    @foreach ($invitations as $invitation)
    <div class="col-4 py-2 text-center">
      <div class="p-3 border bg-light">
        <div class="card mx-auto" style="width: 16rem;">
          <img src="{{$invitation->invitationImage}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{$invitation->name}}</h5>
            <h5 class="card-title"></h5>
            <h5 class="card-title"></h5>
            <p class="card-text">
            <table class="table table-sm table-striped">
              <thead>
                <tr class="bg-primary">
                  <th colspan="2" class="text-left">Invited By</th>
                  <th colspan="2">{{$invitation->host->name}}</th>
                </tr>
                <tr class="bg-warning">
                  <th colspan="2" class="text-left bg-seconday">Total Guests</th>
                  <th>{{$invitation->guests->count()}}</th>
                </tr>
                <tr class="bg-info">
                  <th>Date</th>
                  <th>Venue</th>
                  <th>Dresscode</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$invitation->invitationDate}}</td>
                  <td>{{$invitation->invitationVenue}}</td>
                  <td>{{$invitation->invitationDressCode}}</td>
                </tr>
              </tbody>
            </table>
            </p>
            <a href="{{route('hostinvitations.show',[$host, $invitation])}}" class="btn btn-primary">{{$invitation->name}}</a>
          </div>
        </div>

      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection