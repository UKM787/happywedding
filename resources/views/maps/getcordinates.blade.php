@extends('layouts.app')

@section('content')

<div id="mapform">

  <form class="mapinfo" method="POST" action="{{route('getcordinates')}}">
    @csrf
    <label>Address</label>
    <input type="text" id="address" name="address" />
    </br>
    <label>city</label>
    <input type="text" id="city" name="city" />
    </br><label>state</label>
    <input type="text" id="state" name="state" />
    </br><label>country</label>
    <input type="text" id="country" name="country" />
    </br><label>zip</label>
    <input type="text" id="zip" name="zip" />
    </br>
    <input type="submit" id="submit" name="submit" />
  </form>

</div>


  @endsection