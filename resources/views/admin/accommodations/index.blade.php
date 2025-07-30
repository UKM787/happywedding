@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Accommodations</h2>
        </div>
        <div class="pull-right">
            <a class="btn wed-btn-main" href="{{ route('adminaccommodation.create') }}"> <i class="material-icons" title="Add new accommodation">add</i></a>
        </div>
    </div>
</div>

<div class="row g-3 my-2">
    <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$accommodations->count()}}</h3>
                <p class="fs-5">accommodations</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$locations->count()}}</h3>
                <p class="fs-5">Cites</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

</div>

<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">address</th>
                    <th scope="col">City</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Published</th>
                    <th scope="col">Map</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($accommodations as $accommodation)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $accommodation->name }}</td>
                    <td>{{ $accommodation->description }}</td>
                    <td>{{ $accommodation->address}}</td>
                    <td>{{ $accommodation->location->name}}</td>
                    <td>{{ $accommodation->priority}}</td>
                    <td> {{ $accommodation->longitude}}</td>
                    <td> {{ $accommodation->latitude}}</td>
                    <td>{{ $accommodation->status ? 'Active' : 'Inactive'}}</td>
                    <td><a href="{{ $accommodation->map}}"><i class="material-icons">place</i></a></td>
                    <td><img src="{{asset('assets/accommodations\/').$accommodation->imageOne}}" alt="accommodationImage" style="width:75px; height:50px; border-radius:20%"></td>
                    <td>


                        <a class="badge text-success" href="{{ route('adminaccommodation.show',$accommodation) }}"><span class="material-icons">visibility</span></a>

                        <a class="badge text-primary" href="{{ route('adminaccommodation.edit',$accommodation) }}"><span class="material-icons">edit</span></a>
                        <form action="{{ route('adminaccommodation.destroy',$accommodation) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger btn-xs"><span class="material-icons">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $accommodations->links() !!}
        </div>
    </div>
</div>


@endsection