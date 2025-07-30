<div class="panel-body">
  <div class="col-md-12" style="background-color: #ffe9ec; border-radius: 1em; padding: 1em; margin: 0 0 1em">
    <form action="{{route('guests.store',[$host, $invitation])}}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="col-md-1"></div>
      <!-- .firstformrow -->
      <div class="row mb-2">
        <div class="col">
          <div class="form-outline" style="background-color: white; border-radius: 0.7em;">
            <input name="name" type="text" id="name" class="form-control" placeholder="Name" value="{{old('name') ?? $user->name ?? ''}}" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="background-color: white;border-radius: 0.7em;">
            <input name="mobile" type="text" id="mobile" class="form-control" placeholder="Moblie Number" value="{{old('mobile') ?? $user->mobile ?? ''}}" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="background-color: white; border-radius: 0.7em;">
            <input name="email" type="email" id="email" class="form-control" placeholder="Email" value="{{old('email') ?? $user->email ?? ''}}" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="border-radius: 0.7em;">
            <button type="submit" class="btn  btn-block mb-2" style="border-radius: 1em;   border:0px;  float: right; margin-right: 1em; background-color: #ff1493; color: white;">Upload</button>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
      <!-- firstformends -->

      <div class="col-md-1"></div>
      <!-- formsecond row -->
      <div class="row mb-2">
        <div class="col">
          <div class="form-outline" style="background-color: white;border-radius: 0.7em;">
            <input name="district" type="text" id="district" class="form-control" placeholder="district" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="background-color: white; border-radius: 0.7em;">
            <input name="pin" type="text" id="pin" class="form-control" placeholder="pincode" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="background-color: white;border-radius: 0.7em;">
            <input name="state" type="text" id="state" class="form-control" placeholder="Enter Your State" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="border-radius: 0.7em;">
            <button type="submit" class="btn  btn-block mb-2" style="border-radius: 1em;   border:0px;  float: right; margin-right: 1em; background-color: #ff1493; color: white;">Upload</button>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
      <!--  .formsecond row edns -->
      <div class="col-md-2"></div>
      <!-- .formthirdrow  -->
      <div class="row mb-2">
        <div class="col">
          <div class="form-outline" style="background-color: white;border-radius: 0.7em;">
            <input name="country" type="text" id="country" class="form-control" placeholder="country" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="background-color: white;border-radius: 0.7em;">
            <input name="gender" type="text" id="gender" class="form-control" placeholder="gender" style="border:0px; border-radius: 0.7em;" />
          </div>
        </div>
        <div class="col">
          <div class="form-outline" style="border-radius: 0.7em;">
            <button type="submit" class="btn  btn-block mb-2" style="border-radius: 1em;   border:0px;  float: right; margin-right: 1em; background-color: #ff1493; color: white;">Upload</button>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
      <!-- .formthirdrow ends -->
    </form>
    <!-- formends -->
  </div>
</div>