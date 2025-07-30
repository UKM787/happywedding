        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label('Name:') !!}
            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Hotel Name']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label('Description:') !!}
            {!! Form::textarea('description', old('description'), ['class'=>'form-control', 'placeholder'=>'Hotel Description']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{$errors->has('latitude') ? 'has-error' : ''}}">
            {!! Form::label('latitude') !!}
            {!! Form::text('latitude', old('latitude'), ['class' => 'form-control', 'placeholder' => 'Enter latitude']) !!}
            <span class="text-danger">{{ $errors->first('latitude') }}</span>
        </div>

        <div class="form-group {{$errors->has('longitude') ? 'has-error' : ''}}">
            {!! Form::label('longitude') !!}
            {!! Form::text('longitude', old('longitude'), ['class' => 'form-control', 'placeholder' => 'Enter longitude']) !!}
            <span class="text-danger">{{ $errors->first('longitude') }}</span>
        </div>

        <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
            {!! Form::label('Category:') !!}
            {!! Form::select('parent_id',$vendorcats, 'Leave Empty for State', ['class'=>'form-control', 'placeholder'=>'Leave Empty for State']) !!}
            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
        </div>

        <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
            {!! Form::label('Location:') !!}
            {!! Form::select('locationmaster_id',$locationcats, 'Leave Empty for State', ['class'=>'form-control', 'placeholder'=>'Leave Empty for State']) !!}
            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
        </div>

        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            {!! Form::label('status', 'Publish: ') !!}
            {!! Form::checkbox('status', null ,['class' => 'form-control'])!!}
            <span class="text-danger">{{ $errors->first('status') }}</span>
        </div>

        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
            {!! Form::label('icon', 'Icon: ') !!}
            {!! Form::text('icon', null ,['class' => 'form-control'])!!}
            <span class="text-danger">{{ $errors->first('icon') }}</span>
        </div>

        <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
            {!! Form::label('priority', 'Listing Priority: ') !!}
            {{ Form::select('priority',   ['1' => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', '9' => 'nine'] , '1', ['class' => 'form-control','placeholder' => 'Listing Priority..']) }}
            <span class="text-danger">{{ $errors->first('priority') }}</span>
        </div>

        <div class="form-group {{ $errors->has('imageOne') ? 'has-error' : '' }}">
            {!! Form::label('imageOne', 'Image: ') !!}
            {!! Form::file('imageOne') !!}
            <span class="text-danger">{{ $errors->first('imageOne') }}</span>
        </div>

        <div class="form-group">
            @if(isset($location->imageOne))
            <img src="{{asset('img/cities\/').$location->imageOne}}" alt="Location Image" width="75px" height="auto">
            @else
            <img src="{{asset('img/cities\/').'cityDefault.png'}}" alt="locationImage" id="imageOneTag" width="75px" height="auto">
            @endif
        </div>

      