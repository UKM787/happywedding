<div class="row my-5">
    <div class="d-flex justify-content-center">
        {!! $tasks->links() !!}
    </div>
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th colspan="9" class="h4 text-center">Task Categories and Tasks</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 0 ?>
                @foreach ($tasks as $task)
                @if($task->parent_id == null)
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
                    <td>{{ ++$sno}}</td>
                    <td><i class="{{$task->icon}}"></i>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>@if($task->parent_id != NULL ) {{ $categories->where('id', $task->parent_id)->first()->name}} @else {{$task->name }} @endif</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive'}}</td>
                    <td colspan="2">@if(isset($task->imageOne)) <img src="{{App\Wed\Happy::TASKIMGPATH.$task->imageOne}}" alt="taskImage" style="border-radius:20%" width="72px" height="auto" @else 'no image' @endif></td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('admintask.show',$task) }}"><span class="material-icons" style="font-size: 1em;">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('admintask.edit',$task) }}"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('admintask.destroy',$task) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                    @if($task->children->isNotEmpty())
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
                @foreach($task->children as $key=>$vend)
                <tr>
                    <td>
                    <td>{{ ++$j }}</td>
                    <td><i class="{{$vend->icon}}"></i>{{ $vend->name }}</td>
                    <td>{{ $vend->description }}</td>
                    <td>@if($vend->parent_id != NULL ) {{ $categories->where('id', $vend->parent_id)->first()->name}} @else {{$vend->name }} @endif</td>
                    <td>{{ $vend->priority }}</td>
                    <td>{{ $vend->status == 1 ? 'Active' : 'Inactive'}}</td>
                    <td>@if(isset($vend->imageOne)) <img src="{{App\Wed\Happy::TASKIMGPATH.$vend->imageOne}}" alt="taskImage" style="border-radius:20%" width="48px" height="auto" @else 'no image' @endif></td>
                    <td class="d-flex justify-content-center">
                        <a class="badge text-success" href="{{ route('admintask.show',$vend) }}"><span class="material-icons" style="font-size: 1em;">visibility</span></a>

                        <a class="badge text-warning" href="{{ route('admintask.edit',$vend) }}"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('admintask.destroy',$vend) }}" method="POST">
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
        {!! $tasks->links() !!}
    </div>
</div>