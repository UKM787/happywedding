@extends('layouts.host')


@section('content')

<form method="POST" action="#" enctype="multipart/form-data">

  @include('host.invitations.partials._create', ['submitBtn' => 'Create'])

</form>

<!-- wed-main-submenu starts -->
<div class="container">
  <ul class="nav nav-pills mb-3 top-nav mb-5" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-invitationcover-tab" data-bs-toggle="pill" data-bs-target="#pills-invitationcover" type="button" role="tab" aria-controls="pills-invitationcover" aria-selected="true">InvitationCover</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-savethedate-tab" data-bs-toggle="pill" data-bs-target="#pills-savethedate" type="button" role="tab" aria-controls="pills-savethedate" aria-selected="false">SaveTheDate</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-ourstory-tab" data-bs-toggle="pill" data-bs-target="#pills-ourstory" type="button" role="tab" aria-controls="pills-c" aria-selected="false">OurStory</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-ecard-tab" data-bs-toggle="pill" data-bs-target="#pills-ecard" type="button" role="tab" aria-controls="pills-ecard" aria-selected="false">e-card</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-invitationcover" role="tabpanel" aria-labelledby="pills-invitationcover-tab">
      <img src="{{asset('storage/hosts/invitation-cover.png')}}" alt="invitation-cover" class="img-fluid">
      <!-- .invitationDetails ends-->
    </div>
    <div class="tab-pane fade" id="pills-savethedate" role="tabpanel" aria-labelledby="pills-savethedate-tab">
      <img src="{{asset('storage/hosts/savethedate.png')}}" alt="savethedate" class="img-fluid">
    </div>
    <!-- ourstoryDetails starts -->
    <div class="tab-pane fade show" id="pills-ourstory" role="tabpanel" aria-labelledby="pills-ourstory-tab">
      <img src="{{asset('storage/hosts/invitation-story.png')}}" alt="invitation-story" class="img-fluid">
    </div>
    <!-- ourstory details ends -->
    <div class="tab-pane fade" id="pills-ecard" role="tabpanel" aria-labelledby="pills-ecard-tab">
      <img src="{{asset('storage/hosts/invitation-e-card.png')}}" alt="invitation-e-card" class="img-fluid">
    </div>
    <!-- galleryDetails starts -->
    <div class="tab-pane fade show" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
      <img src="{{asset('storage/hosts/invitation-gallery-album2.png')}}" alt="invitation-galleryalbum2" class="img-fluid">
    </div>
    <!-- galleryDetails ends -->
  </div>
</div>

@endsection