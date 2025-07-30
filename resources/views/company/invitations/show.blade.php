@extends('layouts.hostinvitation')
@section('content')

<div class="gy-5">
  <div class="col-12 py-2 text-center">
    <div class="p-3 border bg-light">
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <div class="accordion-button bg-nav text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              {{$invitation->name}} by {{$host->name}}
            </div>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
              <div class="card" style="width: 100%;">
                <img src="{{$invitation->invitationImage}}" class="card-img-top" alt="..." style="height:300px">
                <div class="card-body">
                  <h3 class="card-title bg-nav text-white">{{$invitation->name}} Schedule</h3>
                  <p class="card-text">
                  <table class="table table-sm table-striped table-sm table-bordered">
                    <thead>
                      <tr class="bg-primary text-center">
                        <th>Invited By</th>
                        <th>Total Guests</th>
                        <th>Starts</th>
                        <th>Ends</th>
                        <th>Ceramonies</th>
                      </tr>
                      <tr class="bg-warning">
                        <td>{{ucwords($invitation->host->name)}}</td>
                        <td>{{$invitation->guests->count()}}</td>
                        <td>{{$invitation->startDate}}</td>
                        <td>{{$invitation->endDate}}</td>
                        <td>{{$invitation->ceramonies->count()}}</td>
                      </tr>
                      <tr>
                        <td colspan="5"><span class="h3">Bride</span> <img src="{{$invitation->member->brideImage}}" class="card-img-top" alt="..." style=" width: 100px; height:100px"></td>
                      </tr>
                      <tr class="bg-primary">
                        <td>{{ucwords($invitation->member->brideName)}}</td>
                        <td>{{ucwords($invitation->member->brideMotherName)}}</td>
                        <td>{{ucwords($invitation->member->brideFatherName)}}</td>
                        <td>{{$invitation->member->brideEmail}}</td>
                        <td>{{$invitation->member->brideMobile}}</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td colspan="5"><span class="h3">Groom</span> <img src="{{$invitation->member->groomImage}}" class="card-img-top" alt="..." style=" width: 100px; height:100px">
                        </td>
                      </tr>
                      <tr class="bg-secondary">
                        <td>{{ucwords($invitation->member->groomName)}}</td>
                        <td>{{ucwords($invitation->member->groomMotherName)}}</td>
                        <td>{{ucwords($invitation->member->groomFatherName)}}</td>
                        <td>{{$invitation->member->groomEmail}}</td>
                        <td>{{$invitation->member->groomMobile}}</td>
                      </tr>
                    </thead>
                  </table>
                  </p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <h3 class="card-title bg-nav text-white">Ceramonies Details</h3>
                    <table class="table table-sm table-striped table-sm table-bordered">
                      <tbody>
                        <tr class="bg-primary text-white h3">
                          <td colspan="2">Name</td>
                          <td>Starts</td>
                          <td>Ends</td>
                          <td>Dresscode</td>
                          <td colspan="2">Venue</td>
                        </tr>
                        @foreach($invitation->ceramonies as $ceramony)
                        <tr>
                          <td colspan="2">{{$ceramony->name}}</td>
                          <td>{{$ceramony->startDate}}</td>
                          <td>{{$ceramony->endDate}}</td>
                          <td>{{$ceramony->dressCode}}</td>
                          <td>{{$ceramony->venue->name}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </li>
                  <li class="list-group-item">
                    <h3 class="card-title bg-nav text-white">Ceramonoies Venue</h3>
                    <table class="table table-sm table-striped table-bordered">
                      <tbody>
                        <tr class="bg-success">
                          <td colspan="2">Name</td>
                          <td colspan="2">Address</td>
                          <td>City</td>
                          <td>Pincode</td>
                          <td>State</td>
                          <td>Country</td>
                          <td><img src="{{asset('storage/guests').'/img/white-marker.png'}}" alt="markar" class="img-fluid" style="width: 15px;"></td>
                        </tr>
                        <tr>
                          <td colspan="2">{{$ceramony->venue->name}}</td>
                          <td colspan="2">{{$ceramony->venue->address}}</td>
                          <td>{{$ceramony->venue->city}}</td>
                          <td>{{$ceramony->venue->pincode}}</td>
                          <td>{{$ceramony->venue->state}}</td>
                          <td>{{$ceramony->venue->country}}</td>
                          <td>{{$ceramony->venue->reachHere}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </li>
                </ul>
                <div class="card-body">
                  <a href="#" class="btn btn-primary px-3">Guests</a>
                  <a href="#" class="btn btn-secondary px-3">Support Staff</a>
                  <a href="#" class="btn btn-primary px-3">Logitics</a>
                  <a href="#" class="btn btn-secondary px-3">Accomodation</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Ceramonies
            </div>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              <table class="table table-sm table-striped table-sm table-bordered">
                <tbody>
                  <tr class="bg-primary text-white h3">
                    <td colspan="2">Name</td>
                    <td>Starts</td>
                    <td>Ends</td>
                    <td>Dresscode</td>
                    <td>Venue</td>
                  </tr>
                  @foreach($invitation->ceramonies as $ceramony)
                  <tr>
                    <td colspan="2">{{$ceramony->name}}</td>
                    <td>{{$ceramony->startDate}}</td>
                    <td>{{$ceramony->endDate}}</td>
                    <td>{{$ceramony->dressCode}}</td>
                    <td>{{$ceramony->venue->name}}</td>
                  </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header bg-nav text-white" id="panelsStayOpen-headingThree">
            <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
              Invitation Venue
            </div>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
              <table class="table table-sm table-striped table-bordered">
                <tbody>
                  <tr class="bg-success">
                    <td colspan="2">Name</td>
                    <td colspan="2">Address</td>
                    <td>City</td>
                    <td>Pincode</td>
                    <td>State</td>
                    <td>Country</td>
                    <td><img src="{{asset('storage/guests').'/img/white-marker.png'}}" alt="markar" class="img-fluid" style="width: 15px;"></td>
                  </tr>
                  <tr>
                    <td colspan="2">{{$ceramony->venue->name}}</td>
                    <td colspan="2">{{$ceramony->venue->address}}</td>
                    <td>{{$ceramony->venue->city}}</td>
                    <td>{{$ceramony->venue->pincode}}</td>
                    <td>{{$ceramony->venue->state}}</td>
                    <td>{{$ceramony->venue->country}}</td>
                    <td>{{$ceramony->venue->reachHere}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection