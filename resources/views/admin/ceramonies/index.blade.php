@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ceramonies</h2>
        </div>
        <div class="pull-right">
            <a class="btn wed-btn-main" href="{{ route('adminceramony.create') }}"> <i class="material-icons" title="Add new Ceramony">add</i></a>
        </div>
    </div>
</div>

<div class="row g-3 my-2">
    <div class="col-md-6 offset-3 text-center">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$ceramonyCount}}</h3>
                <p class="fs-5">Ceramonies</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>


</div>

<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="20">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th colspan="3" scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ceramonies as $ceramony)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $ceramony->name }}</td>
                    <td>{{ $ceramony->type }}</td>
                    <td>{{ $ceramony->priority }}</td>
                    <td>{{ $ceramony->status ? 'Active' : 'Inactive'}}</td>
                    <td colspan="3">
                        @foreach($ceramony->imageOne as $ceraimg)
                        <img src="{{App\Wed\Happy::CERIMGPATH. $ceraimg}}" alt="{{$ceraimg.'Image'}}" width="50" height="36px" class="px-1">
                        @endforeach
                    </td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('adminceramony.show',$ceramony) }}"><span class="material-icons" style="font-size: 1em;">visibility</span></a>

                        <a class=" badge text-warning" href="{{ route('adminceramony.edit',$ceramony) }}"><span class="material-icons" style="font-size: 1em; ">edit</span></a>

                        <form action="{{ route('adminceramony.destroy',$ceramony->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $ceramonies->links() !!}
        </div>
    </div>

</div>


@endsection