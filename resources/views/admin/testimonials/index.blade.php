@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="d-flex justify-content-around">
    <div>
        <a class="btn wed-btn-main" href="{{route('admintestimonials.index')}}">Testimonials</a>
    </div>
    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
            <h3 class="fs-2">{{$testimonialCount}}</h3>
            <p class="fs-5">testimonials</p>
        </div>
        <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('admintestimonials.create') }}"><i class="material-icons" title="Add new testimonial">add</i></a>
    </div>
</div>


<div class="row g-3 my-2">


    <!-- <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2"></h3>
                <p class="fs-5">Cites</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div> -->

</div>

<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Excerpt</th>
                    <th scope="col">Published</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonials as $testimonial)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $testimonial->title }}</td>
                    <td>{{ $testimonial->body }}</td>
                    <td>@foreach($testimonial->tags as $tag)<strong>{{$tag->name}}</strong>--@endforeach</td>
                    <td>{{ $testimonial->excerpt() }}</td>
                    <td>{{ $testimonial->status ? 'Published' : 'notPublished' }}</td>
                    <td>{{ $testimonial->priority }}</td>
                    <td>@if(isset($testimonial->imageOne)) <img src="{{App\Wed\Happy::TSTIMGPATH.$testimonial->imageOne}}" alt="testimonial Image" style="border-radius:20%" width="48px" height="auto" @else 'no image' @endif></td>
                    <td>

                        <a class="badge text-success" href="{{ route('admintestimonials.show', $testimonial) }}"><span class="material-icons">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('admintestimonials.edit', $testimonial) }}"><span class="material-icons">edit</span></a>

                        @if(auth()->guard('admin')->user() != null && auth()->guard('admin')->user()->role == 'admin')
                        <form action="{{ route('admintestimonials.destroy', $testimonial) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons">delete</span></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $testimonials->links() !!}
        </div>
    </div>
</div>


@endsection