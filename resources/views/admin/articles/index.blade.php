@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="d-flex justify-content-around">
    <div>
        <a class="btn wed-btn-main" href="{{route('adminarticles.index')}}">Articles</a>
    </div>
    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
            <h3 class="fs-2">{{$articleCount}}</h3>
            <p class="fs-5">articles</p>
        </div>
        <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
    </div>
    <div>
        <a class="btn wed-btn-main" href="{{ route('adminarticles.create') }}"><i class="material-icons" title="Add new Article">add</i></a>
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
                    <th scope="col">Cover Image</th>
                    <th scope="col">image Gallery</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->body }}</td>
                    <td>@foreach($article->tags as $tag)<strong>{{$tag->name}}</strong>--@endforeach</td>
                    <td>{{ $article->excerpt() }}</td>
                    <td>{{ $article->status ? 'Published' : 'notPublished' }}</td>
                    <td>{{ $article->priority }}</td>
                    <td>@if(isset($article->imageOne)) <img src="{{App\Wed\Happy::ARTIMGPATH.$article->imageOne}}" alt="article Image" style="border-radius:20%" width="48px" height="auto" @else 'no image' @endif></td>
                    <td>
                        @foreach($article->imageGallery as $img)
                        <img src="{{App\Wed\Happy::ARTIMGPATH. $img}}" alt="{{$img.'Image'}}" width="50" height="36px" class="px-1">
                        @endforeach
                    </td>
                    <td>

                        <a class="badge text-success" href="{{ route('adminarticles.show', $article) }}"><span class="material-icons">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('adminarticles.edit', $article) }}"><span class="material-icons">edit</span></a>

                        @if(auth()->guard('admin')->user() != null && auth()->guard('admin')->user()->role == 'admin')
                        <form action="{{ route('adminarticles.destroy', $article) }}" method="POST">
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
            {!! $articles->links() !!}
        </div>
    </div>
</div>


@endsection