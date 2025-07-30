@extends('layouts.vendor')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Wedding Vendors</h2>
        </div>
        <div class="pull-right">
            <a class="btn wed-btn-main" href="{{ route('admin.vendor.create') }}"><i class="material-icons" title="Add new Vendor">add</i></a>
        </div>
    </div>
</div>

<div class="row g-3 my-2">
    <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$vendors->count()}}</h3>
                <p class="fs-5">Vendors</p>
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
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">City</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Category</th>
                    <th scope="col">Published</th>
                    <th scope="col">Map</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->description }}</td>
                    <td>{{ $vendor->location->name }}</td>
                    <td>{{ $vendor->priority }}</td>
                    <td>{{ $vendor->parent_id }}</td>
                    <td>{{ $vendor->status ? 'Active' : 'Inactive' }}</td>
                    <td><a href="{{ $vendor->map}}"><i class="material-icons">place</i></a></td>
                    <td><img src="{{asset('storage').'/'.$vendor->imageOne}}" alt="Vendor Image" style="width:75px; height:50px; border-radius:20%"></td>
                    <td>


                        <a class="badge text-success" href="{{ route('admin.vendor.show',$vendor) }}"><span class="material-icons">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('admin.vendor.edit',$vendor) }}"><span class="material-icons">edit</span></a>
                        <form action="{{ route('admin.vendor.destroy',$vendor) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $vendors->links() !!}
        </div>
    </div>
</div>


@endsection