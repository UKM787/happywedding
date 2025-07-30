<template>
    <form
        method="POST"
        action=""
        enctype="multipart/form-data"
        name="invitationCoverForm"
        @submit.prevent="submit"
    >
        >
        <div class="form-group-sm row mb-1">
            <div class="col-sm-4">
                <label for="brideName" class="form-label">Bride name</label>
                <input
                    id="brideName"
                    type="text"
                    class="form-control"
                    name="brideName"
                    value=""
                    autocomplete="brideName"
                    v-model="fields.brideName"
                    autofocus
                />
            </div>
            <div class="col-sm-4">
                <label for="brideMobile" class="form-label"
                    >Bride Mobile No.</label
                >
                <input
                    id="brideMobile"
                    type="text"
                    class="form-control"
                    name="brideMobile"
                    value=""
                    autocomplete="brideMobile"
                    v-model="fields.brideMobile"
                />
            </div>
            <div class="col-sm-4">
                <label for="brideEmail" class="form-label">Bride Email</label>
                <input
                    id="brideEmail"
                    type="text"
                    class="form-control"
                    name="brideEmail"
                    value=""
                    autocomplete="brideEmail"
                    v-model="fields.brideEmail"
                />
            </div>
        </div>

        <div class="form-group-sm row mb-1">
            <div class="col-sm-6">
                <label for="brideMotherName" class="form-label"
                    >Bride Mother Name</label
                >
                <input
                    id="brideMotherName"
                    type="text"
                    class="form-control"
                    name="brideMotherName"
                    value=""
                    autocomplete="brideMotherName"
                    v-model="fields.brideMotherName"
                />
            </div>
            <div class="col-sm-6">
                <label for="brideFatherName" class="form-label"
                    >Bride Father Name</label
                >
                <input
                    id="brideFatherName"
                    type="text"
                    class="form-control"
                    name="brideFatherName"
                    value=""
                    autocomplete="brideFatherName"
                    v-model="fields.brideFatherName"
                />
            </div>
        </div>

        <div class="form-group-sm row mb-1">
            <div class="col-sm-4">
                <label for="groomName" class="form-label">Groom Name</label>
                <input
                    id="groomName"
                    type="text"
                    class="form-control"
                    name="groomName"
                    value=""
                    autocomplete="groomName"
                    v-model="fields.groomName"
                />
            </div>
            <div class="col-sm-4">
                <label for="groomMobile" class="form-label"
                    >Groom Mobile Number</label
                >
                <input
                    id="groomMobile"
                    type="text"
                    class="form-control"
                    name="groomMobile"
                    value=""
                    autocomplete="groomMobile"
                    v-model="fields.groomMobile"
                />
            </div>
            <div class="col-sm-4">
                <label for="groomEmail" class="form-label">Groom Email</label>
                <input
                    id="groomEmail"
                    type="text"
                    class="form-control"
                    name="groomEmail"
                    value=""
                    autocomplete="groomEmail"
                    v-model="fields.groomEmail"
                />
            </div>
        </div>

        <div class="form-group-sm row mb-1">
            <div class="col-sm-6">
                <label for="brideMotherName" class="form-label"
                    >Groom Mother Name</label
                >
                <input
                    id="groomMotherName"
                    type="text"
                    class="form-control"
                    name="groomMotherName"
                    value=""
                    autocomplete="groomMotherName"
                    v-model="fields.groomMotherName"
                />
            </div>
            <div class="col-sm-6">
                <label for="groomFatherName" class="form-label"
                    >Groom Father Name</label
                >
                <input
                    id="groomFatherName"
                    type="text"
                    class="form-control"
                    name="groomFatherName"
                    value=""
                    autocomplete="groomFatherName"
                    v-model="fields.groomFatherName"
                />
            </div>
        </div>
        <!-- @if (isset($invitation->startDate))
    {{$invitation->startDate}}
    @else
    {{\Carbon\Carbon::now()}}
    @endif -->
        <div class="form-group-sm row mb-3">
            <div class="col-sm-4">
                <label for="startDate" class="form-label">Wedding Start</label>
                <input
                    id="startDate"
                    type="datetime-local"
                    value=""
                    class="form-control"
                    name="startDate"
                    autocomplete="startDate"
                    v-model="fields.startDate"
                />
            </div>
            <div class="col-sm-4">
                <label for="endDate" class="form-label"
                    >Wedding Completes</label
                >
                <input
                    id="endDate"
                    type="datetime-local"
                    value=""
                    class="form-control"
                    name="endDate"
                    autocomplete="endDate"
                    v-model="fields.endDate"
                />
            </div>

            <div class="col-sm-4">
                <label for="venue_id" class="form-label">Venues</label>
                <select
                    id="venue_id"
                    type="text"
                    class="form-control"
                    name="venue_id"
                    size="5"
                    v-model="fields.venue_id"
                >
                    <option value="" selected disabled>
                        Select your marriage venue
                    </option>
                    <option
                        v-for="venue in venues"
                        :key="venue.id"
                        :value="venue.id"
                    >
                        {{ venue.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group-sm row my-5">
            <div class="col-sm-2 offset-sm-3">
                <div class="upload-cover">
                    <label for="imageOne" class="btn btn-upload btn-red">
                        Upload Photo
                        <i aria-hidden="true" class="fa fa-upload"></i
                    ></label>
                    <input
                        type="file"
                        name="imageOne"
                        id="imageOne"
                        accept="image/*"
                        value=""
                        autocomplete="imageOne"
                        aria-label="imageOne"
                        aria-describedby="imageOne"
                        class="form-control-file"
                        hidden="hidden"
                    />
                </div>
            </div>

            <div class="col-sm-2">
                <img
                    src=""
                    alt="Invitation Cover Image"
                    id="imageOneTag"
                    width="150px"
                    height="100px"
                />
            </div>
            <div class="col-sm-2">
                <img
                    src=""
                    alt="Invitation Cover Image"
                    id="imageOneTag"
                    width="150px"
                    height="100px"
                />
            </div>
        </div>

        <div class="form-group-sm row mt-3">
            <div class="col-sm-2 offset-sm-5">
                <button type="submit" class="btn wed-btn-main btn-sm">
                    <span class="material-icons"> save </span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    props: ["hostId", "invitation"],
    data() {
        return {
            venues: null,
            fields: this.invitation,
        };
    },
    mounted() {
        axios.get("/api/host/invitationData").then((response) => {
            this.venues = response.data.data;
            //console.log(response.data.data);
        });
    },
    methods: {
        submit() {
            axios
                .post("", this.fields)
                .then((response) => {
                    this.fields = {};
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
