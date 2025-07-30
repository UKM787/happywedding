<div class="col-12 mb-3">
    <span class="h4">{{$ceramony->name}}</span><sup style="font-size: 0.8em; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$ceramony->type}}</sup>
    <a href="{{route('hostceramony.show',[$host, $invitation,$ceramony])}}" class="h3"><i class="fa fa-eye ml-5" aria-hidden="true" title="viewCeramony"></i></a>
</div>

<div class="card" style="width: 18rem;">
    <img src="{{asset('storage').$ceramony->imageOne}}" class="card-img-top" alt="...">
    <div class="card-body">

        <a href="{{route('hostceramony.edit',[$host,$invitation,$ceramony])}}" class="bg-danger" title="Edit Ceramony">
            <h5 class="card-title text-success">{{$ceramony->name}}<i class="material-icons text-danger" title="Edit Invitation">edit</i>
            </h5>
        </a>



        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$ceramony->startDate}} -
                {{$ceramony->startTime}}
            </li>
            <li class="list-group-item">{{$ceramony->endDate}} -
                {{$ceramony->endTime}}
            </li>
            <li class="list-group-item">
                @foreach ($ceramony->venues as $venue)
                {{$venue->name}}
                {{$venue->description}}
                {{$venue->address}}
                @endforeach
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col">
                        <h5>Ladies Dress Code</h5><img src="{{asset('storage').$ceramony->imageTwo}}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col">
                        <h5>Gents Dress Code</h5><img src="{{asset('storage').$ceramony->imageThree}}" alt="" class="img-thumbnail">
            </li>
    </div>
</div>

</ul>
<div class="card-body">
    <a href="#" class="card-link h3">Ceramony Venue</a>

</div>
</div>
</div>
