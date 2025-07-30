<template>
    <div>
 <div class="form-group-sm row mb-1">
     <div class="col-sm-4">
         <label for="brideName" class="form-label">Bride Name</label>
         <input id="brideName" type="text" class="form-control" name="brideName" value="" autocomplete="brideName" autofocus>
     </div>
     <div class="col-sm-4">
         <label for="brideMobile" class="form-label">Bride Mobile No.</label>
         <input id="brideMobile" type="text" class="form-control" name="brideMobile" value="" autocomplete="brideMobile">
     </div>
     <div class="col-sm-4">
         <label for="brideEmail" class="form-label">Bride Email</label>
         <input id="brideEmail" type="text" class="form-control" name="brideEmail" value="" autocomplete="brideEmail">
     </div>
 </div>

 <div class="form-group-sm row mb-1">
     <div class="col-sm-6">
         <label for="brideMotherName" class="form-label">Bride Mother Name</label>
         <input id="brideMotherName" type="text" class="form-control" name="brideMotherName" value="" autocomplete="brideMotherName">
     </div>
     <div class="col-sm-6">
         <label for="brideFatherName" class="form-label">Bride Father Name</label>
         <input id="brideFatherName" type="text" class="form-control" name="brideFatherName" value="" autocomplete="brideFatherName">
     </div>
 </div>

 <div class="form-group-sm row mb-1">
     <div class="col-sm-4">
         <label for="groomName" class="form-label">Groom Name</label>
         <input id="groomName" type="text" class="form-control" name="groomName" value="" autocomplete="groomName">
     </div>
     <div class="col-sm-4">
         <label for="groomMobile" class="form-label">Groom Mobile No.</label>
         <input id="groomMobile" type="text" class="form-control" name="groomMobile" value="" autocomplete="groomMobile">
     </div>
     <div class="col-sm-4">
         <label for="groomEmail" class="form-label">Groom Email</label>
         <input id="groomEmail" type="text" class="form-control" name="groomEmail" value="" autocomplete="groomEmail">
     </div>
 </div>

 <div class="form-group-sm row mb-1">
     <div class="col-sm-6">
         <label for="brideMotherName" class="form-label">Groom Mother Name</label>
         <input id="groomMotherName" type="text" class="form-control" name="groomMotherName" value="" autocomplete="groomMotherName">
     </div>
     <div class="col-sm-6">
         <label for="groomFatherName" class="form-label">Groom Father Name</label>
         <input id="groomFatherName" type="text" class="form-control" name="groomFatherName" value="" autocomplete="groomFatherName">
     </div>
 </div>

 <div class="form-group-sm row mb-3">
     <div class="col-sm-4">
         <label for="startDate" class="form-label">Wedding Starts</label>
         <input id="startDate" type="datetime-local" value="" class="form-control" name="startDate" autocomplete="startDate">
     </div>
     <div class="col-sm-4">
         <label for="endDate" class="form-label">Wedding Completes</label>
         <input id="endDate" type="datetime-local" value="" class="form-control" name="endDate" autocomplete="endDate">
     </div>

     <div class="col-sm-4">
         <label for="venue_id" class="form-label">Venues</label>
         <select id="venue_id" type="text" class="form-control" name="venue_id" size="5">
             <option value="" selected disabled>Select your marriage venue</option>
         </select>
     </div>
 </div>

 <div class="form-group-sm row my-5">
     <div class="col-sm-2 offset-sm-3">
         <div class="upload-cover"><label for="imageOne" class="btn btn-upload btn-red"> Upload Photo <i aria-hidden="true" class="fa fa-upload"></i></label> <input type="file" name="imageOne" id="imageOne" accept="image/*" value="" autocomplete="imageOne" aria-label="imageOne" aria-describedby="imageOne" class="form-control-file " hidden="hidden"></div>
     </div>
     <div class="col-sm-2"><img src="" alt="Invitation Cover Image" id="imageOneTag" width="150px" height="100px"></div>
 </div>


    </div>
</template>

<script>
export default {
    name: 'Invitation'
};
</script>

<style scoped>
</style>
