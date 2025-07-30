<template>
    <div>
        <!-- <div class="contact">
            <div class="contact-list">
                <ul v-for="contact in contacts" :key="contact.id">
                    <li>
                        <ul
                            v-for="con in contact"
                            v-if="con.host_id == hostId"
                            :key="con.id"
                        >
                            <li>
                                <b class="h5 text-primary"
                                    >Contact {{ con.contact }}</b
                                >
                                <i class="h6 text-secondary">
                                    {{ con.name }} | {{ con.mobile }}</i
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <form @submit.prevent="submit" class="contact-form">
                <div
                    class="wed-host-section-container-title h1 animate__animated animate__bounce animate__delay-2s animate__repeat-2"
                >
                    Contact Form
                </div>
                <div
                    v-if="success"
                    class="alert alert-success alert-dismissible fade show mt-3"
                    role="alert"
                >
                    Contact Saved !
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-group">
                    <input
                        type="hidden"
                        class="form-control"
                        name="host_id"
                        id="name"
                        v-model="fields.host_id"
                    />

                    <label for="contact">For</label>
                    <input
                        type="text"
                        class="form-control"
                        name="contact"
                        id="contact"
                        v-model="fields.contact"
                    />
                    <div v-if="errors && errors.contact" class="text-danger">
                        {{ errors.contact[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        v-model="fields.name"
                    />
                    <div v-if="errors && errors.name" class="text-danger">
                        {{ errors.name[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input
                        type="text"
                        class="form-control"
                        name="mobile"
                        id="mobile"
                        v-model="fields.mobile"
                    />
                    <div v-if="errors && errors.mobile" class="text-danger">
                        {{ errors.mobile[0] }}
                    </div>
                </div>
                <div class="form-group text-center mt-5">
                    <button type="submit" class="btn btn-sm wed-btn-main">
                        <i class="material-icons">save</i>
                    </button>
                </div>
            </form>
        </div> -->
        <div>
            <div class="wed-host-section-container-title">Contact Members</div>
            <div class="d-flex justify-content-around my-4">
                <button
                    v-if="editing"
                    @click="doEdit(false)"
                    class="btn btn-sm btn-cancel"
                    title="close form"
                >
                    Cancel
                </button>
                <button
                    v-else
                    @click="doEdit(true)"
                    class="btn btn-sm wed-btn-main"
                    title="add new Member"
                >
                    <span class="material-icons"> person_add </span>
                </button>
            </div>
            <div class="wed-host-section-container-form" v-if="editing == true">
                <form @submit.prevent="submit" class="contact-form">
                    <div class="form-group">
                        <input
                            type="hidden"
                            class="form-control"
                            name="host_id"
                            id="name"
                            v-model="fields.host_id"
                        />

                        <label for="contact">For</label>
                        <input
                            type="text"
                            class="form-control"
                            name="contact"
                            id="contact"
                            v-model="fields.contact"
                            required
                        />
                        <div
                            v-if="errors && errors.contact"
                            class="text-danger"
                        >
                            {{ errors.contact[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            required
                            v-model="fields.name"
                        />
                        <div v-if="errors && errors.name" class="text-danger">
                            {{ errors.name[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input
                            type="text"
                            class="form-control"
                            name="mobile"
                            id="mobile"
                            required
                            v-model="fields.mobile"
                        />
                        <div v-if="errors && errors.mobile" class="text-danger">
                            {{ errors.mobile[0] }}
                        </div>
                    </div>
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn btn-sm wed-btn-main">
                            <i class="material-icons">save</i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive" v-if="contacts.length > 0">
                <table class="table table-striped mx-auto w-auto" id="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Contact For</th>
                            <th scope="col">Mobile</th>
                            <th scope="row" colpan="2" class="text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in reversedMembers" :key="member.id">
                            <th scope="row">{{ member.name }}</th>
                            <td>{{ member.contact }}</td>
                            <td>{{ member.mobile }}</td>
                            <td
                                @click="
                                    setVal(
                                        member.id,
                                        member.name,
                                        member.contact,
                                        member.mobile
                                    )
                                "
                            >
                                <span class="material-icons text-primary"
                                    >edit</span
                                >
                            </td>
                            <td
                                @click="deleteMember(member.id)"
                                class="text-danger"
                            >
                                <span class="material-icons text-danger"
                                    >delete</span
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
            <div v-if="showForm" class="overlay-form">
                <form
                    @submit.prevent="updateMember($event)"
                    class="task-form-emp"
                >
                    <div class="d-flex justify-content-end">
                        <i
                            @click="showForm = false"
                            style="font-size: 30px; cursor: pointer"
                            class="fas fa-times-circle"
                        ></i>
                    </div>
                    <div class="form-group">
                        <input
                            type="hidden"
                            class="form-control"
                            name="host_id"
                            id="name"
                            v-model="fields.host_id"
                        />

                        <label for="contact">For</label>
                        <input
                            type="text"
                            class="form-control"
                            name="contact"
                            id="contact"
                            v-model="fields.contact"
                            required
                        />
                        <div
                            v-if="errors && errors.contact"
                            class="text-danger"
                        >
                            {{ errors.contact[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            required
                            v-model="fields.name"
                        />
                        <div v-if="errors && errors.name" class="text-danger">
                            {{ errors.name[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input
                            type="text"
                            class="form-control"
                            name="mobile"
                            id="mobile"
                            required
                            v-model="fields.mobile"
                        />
                        <div v-if="errors && errors.mobile" class="text-danger">
                            {{ errors.mobile[0] }}
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary mb-2 btn-custm"
                    >
                        Save
                    </button>
                </form>
            </div>
            <div
                v-if="success"
                class="alert alert-success alert-dismissible fade show mt-3"
                role="alert"
            >
                {{ message }}
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["hostId", "host", "invitation"],
    data() {
        return {
            fields: {
                host_id: this.hostId,
                contact: null,
                name: null,
                mobile: null,
            },
            message: null,
            updateID: null,
            errors: {},
            success: false,
            loaded: true,
            contacts: [],
            //
            editing: false,
            showForm: false,
        };
    },
    mounted() {
        this.loadContacts();
    },
    methods: {
        doEdit(editing) {
            this.editing = editing;
            this.errors = null;
            this.fields.contact = null;
            this.fields.name = null;
            this.fields.mobile = null;
            this.fields.contact = null;
            delete this.fields.slug;
            delete this.fields.invitation_id;
        },

        numberRistrict() {
            document
                .querySelectorAll('input[type="number"]')
                .forEach(function (item) {
                    item.addEventListener("keypress", function (evt) {
                        if (
                            (evt.which != 8 &&
                                evt.which != 0 &&
                                evt.which < 48) ||
                            evt.which > 57
                        ) {
                            evt.preventDefault();
                        }
                    });
                });
        },
        setVal(val_id, val_name, val_for, val_mobile) {
            this.fields.name = val_name;
            this.fields.contact = val_for;
            this.fields.mobile = val_mobile;
            this.updateID = val_id;
            this.showForm = true;
        },
        //
        loadContacts() {
            var _this = this;
            axios
                .get("/getcontacts")
                .then((response) => {
                    _this.contacts = response.data.message;
                })
                .catch((error) => console.log(error));
            //console.log(this.contacts);
            // axios({method: 'GET', url: route('hostinvitationcontact.index', route().params)})
            //     .then( response => {this.contacts = response.data; console.log(this.contacts);})
            //     .catch( error => console.log(errors));
        },
        updateMember() {
            var _this = this;
            this.success = false;
            _this.errors = {};
            //const slug = this.slugify(this.fields.name);
            //const host_id = this.hostid;
            const invitation_id = this.invitation.slug;
            const id = this.updateID;
            //var model = document.getElementById("myModal").value;
            axios
                .patch(
                    `/host/${invitation_id}/invitationcontact/${id}`,
                    _this.fields
                )
                .then((response) => {
                    _this.contacts = response.data.message;
                    _this.success = true;
                    _this.fields = {
                        host_id: this.hostId,
                        contact: null,
                        name: null,
                        mobile: null,
                    }; //Clear input fields.
                    _this.showForm = false;
                    this.message = "updated!";
                    _this.errors = {};
                })
                .catch((error) => {
                    _this.loaded = true;
                    if (error.response.status === 422) {
                        _this.errors = error.response.data.errors || {};
                    }
                });
        },
        deleteMember(e) {
            var _this = this;
            this.success = false;
            _this.errors = {};
            const id = e;
            const invitation_id = this.invitation.slug;
            axios
                .delete(`/host/${invitation_id}/invitationcontact/${id}`)
                .then((response) => {
                    console.log(response.data);
                    _this.contacts = response.data.message;
                    _this.success = true;
                    this.message = "deleted!";
                    _this.errors = {};
                })
                .catch((error) => {
                    _this.loaded = true;
                    if (error.response.status === 422) {
                        _this.errors = error.response.data.errors || {};
                    }
                });
        },
        submit() {
            let _this = this;
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                //const  newfields = {invitation_id : this.invitation.id, slug: 'rajesh'};
                //const slug = this.slugify(this.fields.name);
                //const host_id = this.hostid;
                const invitation_id = this.invitation.id;
                this.fields = { ...this.fields, invitation_id };
                //const params = {host: this.host, invitation: this.invitation, slug: this.slug};
                // console.log(params);
                axios({
                    method: "POST",
                    url: route("hostinvitationcontact.store", route().params),
                    data: this.fields,
                })
                    .then((response) => {
                        console.log(response.data);
                        this.contacts = response.data.messages;
                        this.success = true;
                        _this.fields = {
                            host_id: this.hostId,
                            contact: null,
                            name: null,
                            mobile: null,
                        };
                        this.loaded = true;
                        this.message = "Added!";
                        _this.editing = false;
                        _this.errors = {};
                    })
                    .catch((error) => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            }
        },
        slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        },
    },
    computed: {
        reversedMembers() {
            return [...this.contacts].reverse().sort();
        },
    },
};
</script>

<style scoped>
/* new css */
.overlay-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
}
.task-form-emp {
    width: 60%;
    background-color: #fafafa;
    margin: 12% auto;
    padding: 3em;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
.task-form-emp label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17px;
    line-height: 49px;
    color: #000000;
}
.cont-around {
    display: flex;
    justify-content: space-around;
}
.cont-around > div {
    width: 45%;
}
.multiple_cont > div {
    width: 32%;
}
.btn-custm {
    margin-top: 2em;
}
.edit-btn-tab > button {
    background-color: #461952;
    color: white;
    outline: none;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 1px 0px 0px 1px;
    margin-bottom: 10px;
}
.errMsg {
    color: red;
    font-size: 10px;
}
.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;

    justify-content: center;
    margin-left: 20%;
    margin-right: 20%;
}

.position-ref {
    position: relative;
}

.content {
    text-align: center;
}

.btn-cancel {
    background: #ef5753;
    color: #000;
}

.btn-cancel:hover {
    background: #e3342f;
    color: rgba(255, 255, 255);
}

td {
    cursor: pointer;
}

input:hover {
    background-color: pink;
    cursor: pointer;
}

/* new css end */
.contact-form {
    height: 100vh;
    position: relative;
    /* top: 8em;
    left: 3em; */
}

.alert-success {
    position: fixed;
    right: 25px;
    bottom: 25px;
}

ul {
    list-style-type: none;
}
</style>
