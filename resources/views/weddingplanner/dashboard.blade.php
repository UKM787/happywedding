@extends('layouts.app')

@section('content')
<div class="container">
    <weddingplanner-welcome :planner="{{ json_encode($planner) }}"></weddingplanner-welcome>
</div>
@endsection