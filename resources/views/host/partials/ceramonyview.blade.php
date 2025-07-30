<div class="row mb-5">
    <div class="box-wrap admin-form mb-3">
        <div class="col-12 mb-3">
            <span class="h4">{{$ceramony->name}}</span><sup style="font-size: 0.8em; color:white; background-color:red; border-radius:1em; padding: 0.2em">{{$ceramony->type}}</sup>
            <a href="{{route('hostceramony.show',[$host, $invitation,$ceramony])}}" class="h3"><i class="fa fa-eye ml-5" aria-hidden="true" title="viewCeramony"></i></a>
        </div>
        <div class="row g-3">
            <div class="col-6">
                <label for="startDate" class="pull-right">Start Date / Time</label>
                <div class="input-group">
                    <input name="startDate" type="string" aria-label="startDate" class="form-control" value="{{ old('startDate') ?? $ceramony->startDate }}" {{$wedform}}>
                    <input name="startTime" type="string" aria-label="startTime" class="form-control" value="{{ old('startTime') ?? $ceramony->startTime }}" {{$wedform}}>
                </div>
            </div>
            <div class="col-6">
                <label for="endDate" class="pull-right">End Date / Time</label>
                <div class="input-group">
                    <input name="endDate" type="string" aria-label="endDate" class="form-control" value="{{ old('endDate') ?? $ceramony->endDate }}">
                    <input name="endTime" type="string" aria-label="endTime" class="form-control" value="{{ old('endTime') ?? $ceramony->endTime }}">
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-6">
                <label for="venue_id" class="pull-right px-3">Venue</label>
                <div class="input-group">
                    <select name="venue" id="venue_id" class="form-control" {{$wedform}}>Venue
                        <option value="selected">Select Venue</option>
                        @foreach($venues as $key => $value)
                        <option value="{{$key}}" {{ ($ceramony->venue == $key) ? 'selected' : ''  }}>
                            {{$value}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <label for="imageOne" class="pull-right">Ceramony Photo</label>
                <input type="file" name="imageOne" id="imageOne" class="form-control">
                @if($ceramony->imageOne == null)
                <img src="{{asset('storage').'/ceramony/ceramonyDefault.png'}}" alt="" width="100px">
                @else
                <img src="{{asset('storage').$ceramony->imageOne}}" id="imageOneTag" alt="" width="100px">
                @endif
            </div>
        </div>
        <h5 class="btn btn-xs">Dress code</h5>
        <div class="row mt-3 mb-5">
            <div class="col-6">
                <label for="imageThree" class="pull-right">Gentlemen</label>
                <input type="file" name="imageThree" id="imageThree" class="form-control">
                @if($ceramony->imageOne == null)
                <img src="{{asset('storage').'/ceramony/ceramonyDefault.png'}}" alt="" width="100px">
                @else
                <img src="{{asset('storage').$ceramony->imageThree}}" id="imageTwoTag" alt="" width="100px">
                @endif
            </div>
            <div class="col-6">
                <label for="imageThree" class="pull-right">Ladies</label>
                <input type="file" name="imageThree" id="imageThree" class="form-control">
                @if($ceramony->imageOne == null)
                <img src="{{asset('storage').'/ceramony/ceramonyDefault.png'}}" alt="" width="100px">
                @else
                <img src="{{asset('storage').$ceramony->imageThree}}" id="imageTwoTag" alt="" width="100px">
                @endif
            </div>
        </div>


        @if($wedform != 'disabled')
        <div class="form-group row mb-3">
            <div class="col-sm-2 offset-sm-3">
                <button type="submit" class="btn wed-form-button">
                    {{__($submitBtn)}}
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
