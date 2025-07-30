@extends('layouts.guest')

@section('content')

<div class="row">
  <div class="col-md-2">
    <a href="{{route('guestfamily.create', $user)}}" class="btn bg-nav"><i class="material-icons">&#xE147</i></a>
  </div>
  <div class="col-md-10">
    <h3 class=" text-center bg-nav text-white p-2">Family Members</h3>
  </div>
</div>

<div class="row">
  @if($user->guestfamily)
  @foreach($user->guestfamily->toArray() as $family)
  <div class="col-md-4 p-4">
    <table class="table-dark table-bordered">
      @foreach($family as $key => $val)
      <tr>
        <td class="p-2">{{$key}}</td>
        <td class="p-2">{{$val}}</td>
      </tr>
      @endforeach
    </table>
  </div>
  @endforeach
  @endif
</div>


@endsection