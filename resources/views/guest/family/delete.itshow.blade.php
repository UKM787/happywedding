@extends('layouts.guest')

@section('content')

<div class="row mb-3">
  <div class="col-md-1">
    <a href="{{route('guestfamily.create', $user)}}" class="btn bg-nav text-white h4 p-2"><i class="material-icons">&#xE147</i></a>
  </div>
  <div class="col-md-5">
    <h4 class=" text-center bg-nav text-white p-2">{{$user->name }} Family</h3>
  </div>
  <div class="col-md-4">
    <h4 class=" text-center bg-nav text-white p-2">Members Attending Marriage</h3>
  </div>
  <div class="col-md-2">
    <h5 class=" text-center bg-nav text-white p-2">{{$user->family->count()}}</h3>
  </div>
</div>

@if($user->guestfamily)
@foreach($user->family->toArray() as $family)
<div class="row">
  <div class="col-md-12 mb-3">
    <table class="table-dark table-striped table-bordered">
      @foreach($family as $key => $val)
      <tr>
        <td class="p-2">{{$key}}</td>
        <td class="p-2">{{$val}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endforeach
@endif

@endsection