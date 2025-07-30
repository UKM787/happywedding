@extends('layouts.guest')

@section('content')

<div class="row">

  <div class="col-md-4 p-2"> <a href="{{route('guesthome.edit',[$user, $guesthome])}}" class="btn mr-2 bg-nav text-white">{{$user->name }} Home Address <i class="material-icons" title="Edit Article">edit</i></a></div>

</div>

<div class="row">
  <div class="col-md-4">
    <table class="table-primary table-bordered">
      @foreach ($user->guesthome->toArray() as $key => $val)
      <tr>
        <td class="p-2">{{$key}}</td>
        <td class="p-2">{{$val}}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection