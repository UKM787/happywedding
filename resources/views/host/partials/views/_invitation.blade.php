<div class="container animate__animated animate__fadeInLeft">
    @if($invitation != null)
    <div class="wed-host-section">
        <div class="wed-host-section-container">
            @if(isset($host))
            <div class="logo-top-right">
                <a href="{{route('hostinvitations.edit',[$invitation])}}">
                    <i class="material-icons icon-top-design" title="Edit Invitation">edit</i></a>
            </div>
            @endif
            <div class="wed-host-section-container-firstImg">
                <img src="{{asset('storage').$invitation->imageOne}}" class="wed-host-section-container-firstImg-style">
            </div>
            <div class="wed-host-section-container-title animate__animated animate__bounce animate__delay-2s">
                <div>{{$invitation->groomName}}</div>
                <div> weds </div>
                <div>{{$invitation->brideName}} </div>
            </div>
            <div class="wed-host-invitation-description">
                <div>
                    THE PLEASURE OF YOUR COMPANY IS <br> REQUESTED <br>AT THE MARRIAGE
                </div>
                @foreach($invitation->venues as $venue)
                <div>
                    {{$venue->name}}
                </div>
                @endforeach
                <div>
                    {{$invitation->state}} , {{$invitation->location->name}}
                </div>
                <div>
                    {{\Carbon\Carbon::parse($invitation->startDate)->format('d M, Y H:i:s')}} 
                </div>
            </div>
        </div>
        <!-- .wed-host-invitation-cover ends -->
    </div>
    @else
    @if(isset($host))
    <a href="{{route('hostinvitations.create', $host)}}" class="btn bg-nav text-white h4" title="create wedding invitation"><i class="material-icons p-2">Create Invitation</a>
    @endif
    @endif
</div>
<!-- .wed-host-section ends -->
