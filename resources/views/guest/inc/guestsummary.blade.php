  <div class="welcome" style="position:relative">
      <!-- .middle-wrapper ends -->

      <div class="middle-wrapper">
          <!-- .bg-yellow starts -->
          <div class="bg-yellow width-100 guest-nav-box">
              <h5>{{$user->name}} Invitations</h5>
              <a title="New Invitations" href="{{route('guestnew-invitations',$user)}}" class="count">
                  <div>
                      <h5>New Invitations</h5>
                      <h5>{{count($inviteNew)}}</h5>
                  </div>
              </a>
              <a title="Accepted Invitations" href="{{route('guestaccepted-invitations',$user)}}" class="count">
                  <div>
                      <h5>Accepted</h5>
                      <h5>{{count($inviteAccepted)}}</h5>
                  </div>
              </a>
              <a title="Declined Invitations" href="{{route('guestdeclined-invitations',$user)}}" class="count">
                  <div>
                      <h5>Declined</h5>
                      <h5>{{count($inviteRejected)}}</h5>
                  </div>
              </a>
              <a title="Pending Invitations" href="{{route('guestpending-invitations',$user)}}" class="count">
                  <div>
                      <h5>Pending</h5>
                      <h5>{{count($invitePending)}}</h5>
                  </div>
              </a>
              <a title="Pending Invitations" href="{{route('guestwelcome.index', $user)}}" class="count">
                  <div>
                      <h5>All</h5>
                      <h5>{{count($invitePending) + count($inviteAccepted) + count($inviteRejected) + count($inviteNew)}}</h5>
                  </div>
              </a>
          </div>

          <div class="bg-yellow invited-box-right width-100">
              <div class="time-schedule">
                  <h4>Today's schedule</h4>
                  <div class="date">
                      <h5>{{date('d-m-Y')}}</h5>
                  </div>
              </div>
              <div class="d-flex align-items-center flex-wrap justify-content-center pt-3  width-100">
                  <div style="width: 100px;">
                      <img src="{{asset('storage/theme').'/chess.png'}}" alt="" class="img-fluid w-100">
                  </div>
                  <div>
                      <ul class="mb-0 list-unstyled mx-4">
                          <li> <img src="{{asset('storage/theme').'/list-1.png'}}" alt="" style="width:20px;" class="img-fluid"> <span class="color-pink">Haldi</span> </li>
                          <li> <img src="{{asset('storage/theme').'/list-2.png'}}" alt="" style="width:20px;" class="img-fluid"> <span class="color-pink">12:00 Noon - 5:00 pm</span> </li>
                          <li> <img src="{{asset('storage/theme').'/list-3.png'}}" alt="" style="width:20px;" class="img-fluid"> <span class="color-pink"> Taj palace, Egmore, Channnai</span></li>
                      </ul>
                  </div>
              </div>
          </div>
          <!-- bg-yellow ends  -->
          <div class=" invited-box-cal width-100 width-50">
              <div class="green-calendar">
                  <div class="calendar-header">
                      <h5>December 2019</h5>
                      <div>
                          <i class="fas fa-chevron-left"></i>
                          <i class="fas fa-chevron-right"></i>
                      </div>
                  </div>
                  <div class="table-box">
                      <guest-single-calander></guest-single-calander>
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <tr class="border-0">
                                  <th>Mo</th>
                                  <th>Tu</th>
                                  <th>We</th>
                                  <th>Th</th>
                                  <th>Fr</th>
                                  <th>Sa</th>
                                  <th>Su</th>
                              </tr>
                              <tr>
                                  <td>1</td>
                                  <td>2</td>
                                  <td>3</td>
                                  <td>4</td>
                                  <td>5</td>
                                  <td>6</td>
                                  <td>7</td>
                              </tr>
                              <tr>
                                  <td>8</td>
                                  <td>9</td>
                                  <td>10</td>
                                  <td>11</td>
                                  <td>12</td>
                                  <td>13</td>
                                  <td>14</td>
                              </tr>
                              <tr>
                                  <td>15</td>
                                  <td>16</td>
                                  <td>17</td>
                                  <td>18</td>
                                  <td>19</td>
                                  <td>20</td>
                                  <td>21</td>
                              </tr>
                              <tr>
                                  <td>22</td>
                                  <td>23</td>
                                  <td>24</td>
                                  <td>25</td>
                                  <td>26</td>
                                  <td>27</td>
                                  <td>28</td>
                              </tr>
                              <tr>
                                  <td>29</td>
                                  <td>30</td>
                                  <td>31</td>
                                  <td>1</td>
                                  <td>2</td>
                                  <td>3</td>
                                  <td>4</td>
                              </tr>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- .notifications -->
          <div class="notifications width-100 width-50">
              <h4 class="p-3">Notifications</h4>

              <div class="wed-host-notif-cont-big">
                  @if(isset($notifications) && $notifications->isNotEmpty())
                  @foreach($notifications as $notification)
                  <ul class="notify_item">
                      @switch($notification->type)

                      @case ("App\Notifications\Host\AccommodationNotifications")
                      <li>
                          @if(isset($notification->data['profile']['imageOne']) )
                          <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @else
                          <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @endif
                      </li>
                      @break;

                      @case ("App\Notifications\Host\InvitationNotifications")
                      <li>
                          @if( isset($notification->data['profile']['imageOne']) )
                          <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['invitation']['brideName']}} & {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} {{$notification->data['status']}}
                                  {{$notification->data['host']['name']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @else
                          <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>{{$notification->data['invitation']['brideName']}} & {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} {{$notification->data['status']}}
                                  {{$notification->data['host']['name']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @endif
                      </li>
                      @break;

                      @case("App\Notifications\Host\ArrivalNotifications")
                      <li>
                          @if(isset($notification->data['profile']['imageOne']) )
                          <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @else
                          <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @endif
                      </li>
                      @break

                      @case("App\Notifications\Host\DepartureNotifications")
                      <li>
                          @if(isset($notification->data['profile']['imageOne']) )
                          <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @else
                          <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                          <div>
                              <p>
                                  {{$notification->data['host']['name']}} {{$notification->data['status']}}
                              </p>
                              <p>@ {{ $notification->created_at}}</p>
                          </div>
                          @endif
                      </li>
                      @break
                      @endswitch
                  </ul>
                  @endforeach
                  @endif
              </div>
          </div>
          <!-- .notifications ends -->
      </div>
  </div>
  <!-- .welcome ends -->
