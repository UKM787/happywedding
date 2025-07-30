  <!-- .splides starts -->
@if(count($inviteNew) != 0 || count($inviteAccepted) != 0 || count($inviteRejected) != 0 || count($invitePending) != 0)
  <div class="guest-invitation-slider splide" id="guest-invitation-slider">
      <div class="splide__track">
          <ol class="splide__list" style="display:flex;">
              @forelse($invitations as $invitation)
              <li class="splide__slide{{$loop->first ? ' active' : ''}} p-3">
                  <a href=" {{route('guestinvitation',[$user,$invitation])}}">

                      <div class="col-sm-12">
                          @if($invitation->inviteStatus == 6)
                          <div class="invitation-cover p-4" style="background-color: green;">
                          @elseif($invitation->inviteStatus == 5)
                          <div class="invitation-cover p-4" style="background-color: red;">
                          @elseif($invitation->inviteStatus == 4)
                          <div class="invitation-cover p-4" style="background-color: yellow;">
                          @else
                          <div class="invitation-cover p-4">
                          @endif
                              <img src="{{asset('storage').'/'.$invitation->imageOne}}" alt="img" class="img-fluid">
                              <h5 class="text-center name-title">{{ $invitation->brideName }} weds {{ $invitation->groomName}} by {{$invitation->host->name}}</h5>
                              <div>
                                  <ul class="list-unstyled vanue">
                                      <li class="d-flex align-items-center"> <img src="{{asset('storage/theme').'/white-marker.png'}}" alt="markar" class="img-fluid" style="width: 15px;">
                                       <span class="ms-2 px-2">
                                          @foreach($invitation->venues as $venue)
                                           {{$venue->name.'-'.$venue->name}}
                                           @endforeach</span>
                                        </li>
                                      <li class="d-flex align-items-center mt-1"> <img src="{{asset('storage/theme').'/letter.png'}}" alt="markar" class="img-fluid" style="width: 15px;"> <span class="ms-2 px-2 "> {{\Carbon\Carbon::parse($invitation->startDate)->format('j F, Y')}}</span> </li>
                                  </ul>
                              </div>
                              <!-- actions-icon starts -->
                              {{--<div class="actions-icon">
                                  <!-- .invitation-noted -->
                                    <div class="invitation-noted">
                                      <a class="nav-item" href="#" onclick="event.preventDefault();document.querySelector('#{{$invitation->slug}}').submit();">
                                          <img src="{{asset('storage/theme').'/golden-cross.png'}}" alt="golden">
                                      </a>
                                      <form id="{{$invitation->slug}}" action="{{route('guestnoted', [ $user, $invitation])}}" method="POST" style="display: none;">
                                          @csrf
                                          <input type="hidden" name="invitation_name" value="{{$invitation->id}}">
                                      </form>
                                    </div>
                                    <!-- .invitation-noted ends -->
                                    <!-- .invitation-accepted -->
                                    <div class="invitation-accepted">
                                      <a class="nav-item" href="#" onclick="event.preventDefault();document.querySelector('#{{$invitation->slug}}accept').submit();">
                                          <img src="{{asset('storage/theme').'/golden-check.png'}}" alt="check">
                                      </a>
                                      <form id="{{$invitation->slug}}accept" action="{{route('guestaccepted',[$user, $invitation])}}" method="POST" style="display: none;">
                                          @csrf
                                          <input type="hidden" name="invitation_name" value="{{$invitation->id}}">
                                          <input type=text>
                                          <input type="submit" value="submit">
                                      </form>
                                    </div>
                                    <!-- .invitation-accepted ends -->
                                    <!-- .invitation-declined -->
                                    <div class="invitation-declined">
                                      <a class="nav-item" href="#" onclick="event.preventDefault();document.querySelector('#{{$invitation->slug}}reject').submit();">
                                          <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDMyOS4yNjkzMyAzMjkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZD0ibTE5NC44MDA3ODEgMTY0Ljc2OTUzMSAxMjguMjEwOTM4LTEyOC4yMTQ4NDNjOC4zNDM3NS04LjMzOTg0NCA4LjM0Mzc1LTIxLjgyNDIxOSAwLTMwLjE2NDA2My04LjMzOTg0NC04LjMzOTg0NC0yMS44MjQyMTktOC4zMzk4NDQtMzAuMTY0MDYzIDBsLTEyOC4yMTQ4NDQgMTI4LjIxNDg0NC0xMjguMjEwOTM3LTEyOC4yMTQ4NDRjLTguMzQzNzUtOC4zMzk4NDQtMjEuODI0MjE5LTguMzM5ODQ0LTMwLjE2NDA2MyAwLTguMzQzNzUgOC4zMzk4NDQtOC4zNDM3NSAyMS44MjQyMTkgMCAzMC4xNjQwNjNsMTI4LjIxMDkzOCAxMjguMjE0ODQzLTEyOC4yMTA5MzggMTI4LjIxNDg0NGMtOC4zNDM3NSA4LjMzOTg0NC04LjM0Mzc1IDIxLjgyNDIxOSAwIDMwLjE2NDA2MyA0LjE1NjI1IDQuMTYwMTU2IDkuNjIxMDk0IDYuMjUgMTUuMDgyMDMyIDYuMjUgNS40NjA5MzcgMCAxMC45MjE4NzUtMi4wODk4NDQgMTUuMDgyMDMxLTYuMjVsMTI4LjIxMDkzNy0xMjguMjE0ODQ0IDEyOC4yMTQ4NDQgMTI4LjIxNDg0NGM0LjE2MDE1NiA0LjE2MDE1NiA5LjYyMTA5NCA2LjI1IDE1LjA4MjAzMiA2LjI1IDUuNDYwOTM3IDAgMTAuOTIxODc0LTIuMDg5ODQ0IDE1LjA4MjAzMS02LjI1IDguMzQzNzUtOC4zMzk4NDQgOC4zNDM3NS0yMS44MjQyMTkgMC0zMC4xNjQwNjN6bTAgMCIgZmlsbD0iI2RhYjIyNyIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiI+PC9wYXRoPjwvZz48L3N2Zz4=" class="img-fluid" style="width: 20px;" />
                                      </a>
                                      <form id="{{$invitation->slug}}reject" action="{{route('guestdeclined',[$user, $invitation])}}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                    </div>
                                    <!-- .invitation-declined ends -->
                              </div>--}}
                              <!-- actions-icon ends -->
                          </div>
                      </div>
                  </a>
              </li>
              @empty
              <div class="text-center" style="background-color:thistle; border-radius: 50%;">
                  <h1 style="padding: 5em 5em; margin: 0 7em;">No Invitations</h1>
              </div>
              @endforelse
          </ol>
      </div>
  </div>
  <!-- .splide ends -->
@endif  


