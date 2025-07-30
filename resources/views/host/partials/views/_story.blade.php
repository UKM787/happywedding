<div class="wed-host-section animate__animated animate__backInRight">
    <div class="wed-host-section-container">
        @if(isset($host) )
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s">{{$invitation->brideName}} weds {{$invitation->groomName}}<span class="pencil-icon"><a href="{{route('hoststory.edit',[$invitation,$story])}}"><i class="material-icons" title="Edit OurStory">edit</i></a></span></div>
        @else
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s">{{$invitation->brideName}} weds {{$invitation->groomName}}</div>
        @endif
        @if(!isset($notice))
        <div class="wed-host-section-container-firstImg">
            <img src="{{{asset('storage').$story->imageOne}}}" class="wed-host-section-container-firstImg-style" alt="...">
        </div>
        <div class="container my-4">
            <div class="row section-1-row">
                <div class="col-sm-8">
                    <h1 class="left-heading-1">How we met</h1>
                    <h3 class="text-intro">{{$story->intro}}</h3>
                </div>
                <div class="col-sm-4 left-div">
                    <div style="position: relative; left: 0; top: 0;">
                        <img src="{{asset('storage').$story->imageTwo}}" class="image-top" />
                        <img src="{{asset('storage').$story->imageThree}}" class="image-bottom" />
                    </div>


                </div>
            </div>
        </div>

        <!-- time line is started -->
        <div class="container">
            <section class="timeline-section">
                <div class="timeline-items">
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="fa fa-heart icon" aria-hidden="true"></i>
                        </div>
                        <div class="h3">Our first Meet</div>
                        <div class="timeline-date"><span>{{\Carbon\Carbon::parse($invitation->story->firstMeet)->format('d M, Y')}}</span></div>
                        <div class="timeline-content">
                            <h5>{{$invitation->story->firstMeetDescription}} </h5>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <!-- <i class="fa fa-map-marker icon" aria-hidden="true"></i> -->
                            <img class="icon" src="{{url('/img/location-1.png')}}" />
                        </div>
                        <div class="timeline-date"><span>{{\Carbon\Carbon::parse($invitation->story->secondMeet)->format('d M, Y')}}</span></div>
                        <div class="timeline-content">
                            <h5>{{$invitation->story->secondMeetDescription}} </h5>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <img class="icon" src="{{url('/img/wedding_bells.png')}}" />
                        </div>
                        <div class="timeline-date"><span>{{\Carbon\Carbon::parse($invitation->story->thirdMeet)->format('d M, Y')}}</span></div>
                        <div class="timeline-content">
                            <h5>{{$invitation->story->thirdMeetDescription}} </h5>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        <div class="container-bottom-img">
            <div class="top-image-1">
                <img src="{{asset('storage').$story->imageFour}}" />
            </div>
            <div class="bottom-image-1">
                <img src="{{asset('storage').$story->imageFive}}" />
                <img src="{{asset('storage').$story->imageSix}}" />

            </div>

        </div>
        @else
        <h1 class="text-danger small text-center">{{$notice}}</h1>
        @endif
    </div>
</div>
