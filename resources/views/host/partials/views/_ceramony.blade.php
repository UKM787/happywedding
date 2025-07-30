<div class="wed-host-section animate__animated animate__backInDown" id="wed-host-ceramonies">
    <div class="wed-host-section-container">
        @if(isset($host))
        <div class="wed-host-section-container-title animate__animated animate__bounce">
            <div class="row" style="justify-content:space-around;">
                <div class="col">
                    <h3 class="text-center">Wedding Ceremonies </h3>
                </div>
                <div class="col">
                    <a href="{{route('hostceramony.create',[$invitation])}}" class="btn btn-sm bg-danger" title="add new Ceramony"><i class="material-icons" title="Add Another Ceramony">add</i>
                    </a>
                </div>
            </div>
            <p class="wed-host-section-container-title animate__animated animate__bounce animate__delay-2s text-danger">
                {{$invitation->brideName}} weds {{$invitation->groomName}}
            </p>
        </div>
         @else
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s">{{$invitation->brideName}} weds {{$invitation->groomName}}</div>

        @endif
        @if(!isset($notice))
        <div class="splide wed-host-ceramonies" id="wed-host-ceramoony">
            <div class="splide__track">
                <ul class="splide__list text-center wed-host-ceramonies-items">

                    @foreach($invitation->ceramonies as $ceramony)
                    <li class="splide__slide {{$loop->index == 0 ? 'active' : ''}}">
                        <span class="wed-host-section-container-title h3 animate__animated animate__bounce ">{{ucwords($ceramony->name)}}</span><sup style="font-size: 0.auto; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$ceramony->type}}</sup>
                        @if(isset($host))
                        <a href="{{route('hostceramony.show',[$invitation,$ceramony])}}" class="h3"><i class="fa fa-eye ml-5" aria-hidden="true" title="viewCeramony"></i></a>
                        @endif
                        <div class="card" style="width: 16rem; ">
                            <img src="{{asset('storage').$ceramony->imageOne}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                @if(isset($host))
                                <a href="{{route('hostceramony.edit',[$invitation,$ceramony])}}" class="bg-danger" title="Edit Ceramony">
                                    <h5 class="card-title text-success">{{$ceramony->name}}<i class="material-icons text-danger" title="Edit Invitation">edit</i>
                                    </h5>
                                </a>
                                @endif
                                <ul class="list-group list-group-flush">
                                    <li class="date text-muted">{{\Carbon\Carbon::parse($ceramony->startDate)->format('d F, Y H:i:s' )}}
                                    </li>
                                    <li class="date text-muted">{{\Carbon\Carbon::parse($ceramony->endDate)->format('d F, Y H:i:s')}}
                                    </li>
                                    <li class="list-group-item">
                                        @foreach ($ceramony->venues as $venue)
                                        <small class="text-muted"><span class="text-primary">{{$venue->name}}</span> ,
                                            {{$venue->description}},
                                            <b>{{$venue->address}}</b>
                                        </small>
                                        @endforeach
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col">
                                                <p class="btn btn-xs">Ladies Dress Code</p><img src="{{asset('storage').$ceramony->imageTwo}}" alt="ladiesDressCode" style="width: 14em ; height: auto">
                                            </div>
                                            <div class="col">
                                                <p class="btn btn-xs">Gents Dress Code</p><img src="{{asset('storage').$ceramony->imageThree}}" alt="GentsDressCode" style="width: 14em ; height: auto">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
         @else
        <h1 class="text-danger small text-center">{{$notice}}</h1>
        @endif

    </div>
</div>
