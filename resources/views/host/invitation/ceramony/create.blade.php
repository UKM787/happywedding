@extends('layouts.hostinvitation')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2">
            Wedding Ceramonies
        </div> 

\        @if(count($ceramonyType) > 0)
        <div class="wed-host-section-container-title h3">
            <nav>
                <ul class="nav" id="nav-tab" role="tablist">
                    @foreach($ceramonyType as $key => $val)
                    <li class="px-3">
                        <a class="{{$loop->index == 0 ? 'active' : ''}}" id="nav-{{$val['name']}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$val['name']}}" type="button" role="tab" aria-controls="nav-{{$val['name']}}" aria-selected="true">{{$val['name']}}<sup style="font-size: 0.6em; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$val['type']}}</sup></a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="row justify-content-sm-center mt-5">
            <div class="col-sm-8">
                <!-- .hotceramony -->
                <div class="tab-content" id="nav-tabContent">
                    @foreach($ceramonyType as $key => $val)
                    <div class="tab-pane fade show {{$loop->index == 0 ? 'active' : ''}}" id="nav-{{$val['name']}}" role="tabpanel" aria-labelledby="nav-{{$val['name']}}-tab">
                        <div class="wed-host-section-container-form">
                            <div class="box-wrap admin-form">
                                <span class="h3">{{ $val['name'] }}<sup style="font-size: 0.6em; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$val['type']}}</sup></span>
                                <form action="{{route('hostceramony.store',[$invitation])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @include('host.partials._ceramony', ['submitBtn' => 'Add', 'wedform' => '', 'val' => $val ])
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


        </div>
        @else
        <h1 class="text-center">Contact Administrator to add more ceremonies!!!!</h1>
        @endif
    </div>
    <!-- .wed-host-section-container ends -->
</div>
<!-- .wed-host-section ends -->
@endsection
