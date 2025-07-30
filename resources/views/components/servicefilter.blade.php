<<div class="row my-5">
    <div class="d-flex justify-content-center">
        {!! $items->links() !!}
    </div>
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th colspan="9" class="h4 text-center">Service Categories and subcategories</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 0 ?>
                @foreach ($items as $item)
                @if($item->parent_id == null)
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col" colspan="2">Image</th>
                    <th scope="col">Action</th>
                </tr>
                @endif
                <tr>
                    <td>{{ ++$sno }}</td>
                    <td><i class="{{$item->icon}}"></i>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>@if($item->parent_id != NULL ) {{ $services->where('id', $item->parent_id)->first()->name}} @else {{$item->name }} @endif</td>
                    <td>{{ $item->priority }}</td>
                    <td>{{ $item->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td colspan="2">@if(isset($item->imageOne)) <img src="{{App\Wed\Happy::SERIMGPATH.$item->imageOne}}" alt="Service Image" style="border-radius:20%" width="72px" height="auto"> @else 'no image' @endif</td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('adminservice.show',$item) }}"><span class="material-icons" style="font-size: 1em;">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('adminservice.edit', $item) }}"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('adminservice.destroy',$item) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                    @if($item->children->isNotEmpty())
                <tr>
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                @endif
                <?php $j = 0; ?>
                @foreach($item->children as $key=>$vend)
                <tr>
                    <td>
                    <td>{{++$j}}</td>
                    <td><i class="{{$vend->icon}}"></i>{{ $vend->name }}</td>
                    <td>{{ $vend->description }}</td>
                    <td>@if($vend->parent_id != NULL ) {{ $services->where('id', $vend->parent_id)->first()->name}} @else {{$vend->name }} @endif</td>
                    <td>{{ $vend->priority }}</td>
                    <td>{{ $vend->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>@if(isset($vend->imageOne)) <img src="{{App\Wed\Happy::SERIMGPATH.$vend->imageOne}}" alt="Service Image" style="border-radius:20%" width="48px" height="auto"> @else 'no image' @endif</td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('adminservice.show',$vend) }}"><span class="material-icons" style="font-size: 1em;">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('adminservice.edit', $vend) }}"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('adminservice.destroy',$vend) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {!! $items->links() !!}
    </div>
    </div>