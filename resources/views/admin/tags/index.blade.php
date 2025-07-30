@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
@if($tags->count() > 0 )
<div class="d-flex justify-content-around">
    <div>
        <a class="btn wed-btn-main" href="{{route('admintag.index')}}">Tags</a>
    </div>

    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
            <h3 class="fs-2">{{$tagCount}}</h3>
            <p class="fs-5">tags</p>
        </div>
        <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('admintag.create') }}"><i class="material-icons" title="Add new Idea">add</i></a>
    </div>
</div>

<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->priority }}</td>
                    <td>{{ $tag->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>@if(isset($tag->imageOne)) <img src="{{App\Wed\Happy::TAGIMGPATH.$tag->imageOne}}" alt="Tag Image" style="border-radius:20%" width="48px" height="auto" @else <img src="{{App\Wed\Happy::TAGIMGPATH.defaultTag.png}}" alt="Tag Image" style="border-radius:20%" width="48px" height="auto" @endif></td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('admintag.show',$tag) }}"><span class="material-icons" style="font-size : 1em;">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('admintag.edit', $tag) }}"><span class="material-icons" style="font-size : 1em;">edit</span></a>

                        <form action="{{ route('admintag.destroy', $tag ) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons" style="font-size : 1em;">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $tags->links() !!}
        </div>
    </div>
</div>

@else
<div class="h3 text-danger"> No Articles Found to Publish</div>
@endif

@endsection