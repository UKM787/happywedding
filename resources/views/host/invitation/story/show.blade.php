@extends('layouts.hostinvitation')

@section('content')
<!-- .story starts -->
<div class="story">
    <h1 class="text-danger text-center"><a href="{{route('hostinvitations.edit',[$invitation])}}">{{$invitation->brideName}} weds {{$invitation->groomName}}<i class="material-icons" title="Edit Invitation">edit</i></a>
    </h1>
    <img src="{{{asset('storage').$story->imageOne}}}" alt="..." style="width:80%; height:400px;">
    <div class="row m-5">
        <div class="col align-self-center">
            <p class="h1">{{$story->intro}}</p>
        </div>
        <div class="col align-self-center">
            <img src="{{asset('storage').$story->imageTwo}}" class="rounded img-thumbnail" alt="...">
            <img src="{{asset('storage').$story->imageThree}}" class="rounded img-thumbnail" alt="...">
        </div>
    </div>


    <div class="row m-5">
        <div class="col col-align-start">
            <p class="h1">{{$invitation->story->firstMeet}}</p>
            <p class="h2">{{$invitation->story->firstMeetDescription}}</p>
        </div>
    </div>
    <div class="row m-5">
        <div class="col col-align-center">
            <p class="h1">{{$invitation->story->secondMeet}}</p>
            <p class="h2">{{$invitation->story->secondMeetDescription}}</p>
        </div>
    </div>
    <div class="row m-5">
        <div class="col col-align-end">
            <p class="h1">{{$invitation->story->thirdMeet}}</p>
            <p class="h2">{{$invitation->story->thirdMeetDescription}}</p>
        </div>
    </div>

    <div class="row m-5">
        <div class="col align-self-start"><img src="{{asset('storage').$story->imageFour}}" class="img-thumbnail" alt="..."></div>
        <div class="col align-self-center"><img src="{{asset('storage').$story->imageFive}}" class="img-thumbnail" alt="..."></div>
        <div class="col align-self-end"><img src="{{asset('storage').$story->imageSix}}" class="img-thumbnail" alt="..."></li>
        </div>
    </div>
</div>
<!-- .story ends -->

<div class="row justify-content-center mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center h4">{{ __(' Our Story ') }}<a href="{{route('hoststory.edit',[$host, $invitation, $story])}}"><i class="material-icons" title="Edit OurStory">edit</i></a></div>

            <div class="card-body">

                <form method="POST" action="{{route('hoststory.edit',[$host, $invitation, $story])}}" enctype="multipart/form-data">

                    @include('host.partials._story', ['submitBtn' => 'Update', 'wedform' => 'disabled'])
                    @csrf
                    @method('PATCH')

            </div>
            <!-- .card-body ends -->

        </div>
        <!-- .card-header ends -->
    </div>
    <!-- .card ends -->
</div>

</div>
<!-- .col-md-12 ends -->
</div>
<!-- .row ends -->
@endsection
