<div class="wed-host-section animate__animated animate__fadeInRight">
    <div class="wed-host-section-container">


        @if(isset($host))
        <h1 class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s">
            <a href="{{route('hostsavedate.edit',[$invitation, $savedate])}}">{{$invitation->brideName}} weds {{$invitation->groomName}}<i class="material-icons text-primary" title="Edit Invitation">edit</i> </a>
        </h1>
        @else
        <h1 class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s">
            {{$invitation->brideName}} weds {{$invitation->groomName}}
        </h1>
        @endif
        @if(!isset($notice))
        <p class="h1 text-success text-center date-decided"> {{ \Carbon\Carbon::parse($invitation->savedate->startDate)->format('d M, Y H:i:s') }}
        </p>
        <!-- <span class="h1 text-danger"> Counter : {{$invitation->savedate->counter}}</span><br> -->
        <div class="countdown-timer col-10">
            <div>
                <span>
                    00
                </span>
                <span>
                    Days
                </span>
            </div>
            <div>
                <span>
                    00
                </span>
                <span>
                    Hours
                </span>
            </div>
            <div>
                <span>
                    00
                </span>
                <span>
                    minutes
                </span>
            </div>
            <div>
                <span>
                    00
                </span>
                <span>
                    Seconds
                </span>
            </div>
        </div>
        <!-- <div class="text-center"><span id="time" class="h1 text-danger">{{$counter}}</span> <i class="text-white">seconds!</i></div> -->
        <div class="wed-host-section-container-firstImg">
            <img src="{{asset('storage').'/'.$invitation->savedate->imageOne}}" class="wed-host-section-container-firstImg-style">
        </div>
        @else
        <h1 class="text-danger small text-center">{{$notice}}</h1>
        @endif
    </div>
    <!-- .wed-hot-invitation-cover-inner-content ends -->
</div>
<!-- .wed-hot-invitation-cover-inner ends -->
</div>
