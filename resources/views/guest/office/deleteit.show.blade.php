@extends('layouts.guest')

@section('content')

<div class="row">

  <div class="col md-2"> <a href="{{route('guestofficeaddress.edit',[$user, $user->guestofficeaddress])}} " class="btn text-white mr-2 bg-nav">{{$user->name}} Office Address <i class="material-icons" title="Edit Article">edit</i></a></div>

</div>

<div class="row mt-4">
  <div class="col-md-4">  
    <table class="table-primary table-bordered">
      @foreach ($user->guestofficeaddress->toArray() as $key => $val)
      <tr>
        <td class="p-2">{{$key}}</td>
        <td class="p-2">{{$val}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection