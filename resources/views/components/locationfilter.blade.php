<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th colspan="8" class="text-center">Country / State /City</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 0 ?>
                @foreach ($locations as $location)
                @if($location->parent_id == null)
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Country</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                @endif
                <tr>
                    <td>{{ ++$srno}}</td>
                    <td class="city">{{ $location->name }}</td>
                    <td>{{ $location->latitude}} </td>
                    <td>{{ $location->longitude}} </td>
                    <td>{{ $location->priority }}</td>
                    <td>{{ $location->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>@if(isset($location->imageOne)) <img src="{{App\Wed\Happy::LOCIMGPATH.$location->imageOne}}" alt="Location Image" style="border-radius:20%" width="48px" height="auto" @else 'no image' @endif></td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('adminlocation.show' , $location) }}" class="badge text-success"><span class="material-icons" style="font-size: 1em;">visibility</span></a>
                        <a href="{{ route('adminlocation.edit', $location) }}" class="badge text-warning"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('adminlocation.destroy', $location) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                    @if($location->children->isNotEmpty())
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">State / City</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                <?php $sno = 0; ?>
                @foreach($location->children as $city)
                <tr>
                    <td>{{ ++$sno}}</td>
                    <td class="city">{{ $city->name }}</td>
                    <td>{{ $city->latitude}} </td>
                    <td>{{ $city->longitude}} </td>
                    <td>{{ $city->priority }}</td>
                    <td>{{ $city->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>@if(isset($city->imageOne)) <img src="{{App\Wed\Happy::LOCIMGPATH.$city->imageOne}}" alt="Location Image" style="border-radius:20%" width="48px" height="auto" @else 'no image' @endif></td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('adminlocation.show', $city) }}" class="badge text-success"><span class="material-icons" style="font-size: 1em;">visibility</span></a>
                        <a href="{{ route('adminlocation.edit', $city) }}" class="badge text-warning"><span class="material-icons" style="font-size: 1em;">edit</span></a>
                        <form action="{{ route('adminlocation.destroy', $city ) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="badge text-danger"><span class="material-icons" style="font-size: 1em;">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>