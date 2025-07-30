<template>
    <div class="wed-host-section">
        <div class="wed-host-section-container">
            <div class="support-memebers-title">
                <span>Support Members</span>
                <img
                    v-if="!editing"
                    @click="doEdit(true)"
                    src="/assets/user-plus.svg"
                    alt=""
                />
            </div>
            <div class="d-flex justify-content-around my-4">
                <button
                    v-if="editing && members.length > 0"
                    @click="doEdit(false)"
                    class="btn btn-sm btn-cancel"
                    title="close form"
                >
                    Close
                </button>
            </div>

            <div class="wed-host-section-container-form" v-if="editing">
                <form class="form-row">
                    <div
                        class="alert alert-danger"
                        role="alert"
                        v-if="hasError"
                    >
                        {{ errMessage }}
                    </div>
                    <div class="form-group-custom">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            required
                            placeholder="Name"
                            name="name"
                            v-model="newMember.name"
                        />
                        <span v-if="errors && errors.name" class="errMsg">{{
                            errors.name[0]
                        }}</span>
                    </div>
                    <div class="form-group-custom">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            required
                            placeholder="Email"
                            name="email"
                            v-model="newMember.email"
                        />
                        <span v-if="errors && errors.email" class="errMsg">{{
                            errors.email[0]
                        }}</span>
                    </div>
                    <div class="form-group-custom">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input
                            type="number"
                            class="form-control"
                            id="mobile"
                            required
                            placeholder="Mobile"
                            name="mobile"
                            v-model="newMember.mobile"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            maxlength="10"
                            @keydown="numberRistrict()"
                        />
                        <span v-if="errors && errors.mobile" class="errMsg">{{
                            errors.mobile[0]
                        }}</span>
                    </div>
                    <div class="form-group-custom">
                        <label for="department_id" class="form-label">Department</label>
                        <Multiselect
                            v-model="newMember.departnment_id"
                            :options="departmentList"
                            label="name"
                            track-by="name"
                            :close-on-select="true"
                            :allow-empty="false"
                            placeholder="Search or Add Departments"
                            id="department_id"
                            :taggable="true" 
                            @tag="addTag"
                            tag-placeholder="Add new"
                            
                        />
                        <span v-if="errors && errors.department_id" class="errMsg">{{
                            errors.department_id[0]
                        }}</span>
                    </div>
                    <div class="form-group-custom">
                        Is leader:
                        <input type="radio" id="True" value='true' v-model="newMember.leader" />
                        <label for="True">True</label>

                        <input type="radio" id="False" value='false' v-model="newMember.leader" />
                        <label for="False">False</label>
                        <span v-if="errors && errors.leader" class="errMsg">{{
                            errors.leader[0]
                        }}</span>
                    </div>
                    <div v-if="newMember.leader == 'false' || newMember.leader == false" class="form-group-custom">
                        <label for="leader_id" class="form-label">Assign Leader</label>
                        <Multiselect
                            v-model="newMember.leader_id"
                            :options="leaderList"
                            label="name"
                            track-by="name"
                            :close-on-select="true"
                            :allow-empty="false"
                            placeholder="Search Leaders"
                            id="leader_id"
                        />
                        <span v-if="errors && errors.leader_id" class="errMsg">{{
                            errors.leader_id[0]
                        }}</span>
                    </div>
                    <div
                        v-if="showForm == false"
                        class="form-group-custom text-center"
                    >
                        <button
                            type="submit"
                            class="btn btn-sm"
                            @click.prevent="createMember()"
                        >
                            <span>Submit</span>
                        </button>
                    </div>
                    <div
                        v-if="showForm == true"
                        class="form-group-custom text-center"
                    >
                        <button
                            type="submit"
                            class="btn btn-sm"
                            @click.prevent="updateMember()"
                        >
                            <span>Update</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-responsive" v-if="members.length > 0">
                <div
                    v-for="member in reversedMembers"
                    :key="member.id"
                    class="member-list-single"
                    @click="toggle($event)"
                >
                    <div class="list-single-name">{{ member.name }}</div>
                    <div class="list-single-email">{{ member.email }}</div>
                    <div class="list-single-email">
                        <div>{{ member.mobile }}</div>
                        <div v-if="!member.roles">
                            <img
                                @click.stop="
                                    setVal(
                                        member
                                    )
                                "
                                src="/assets/edit.svg"
                                alt=""
                            />
                            <img
                                @click.stop="deleteMember(member)"
                                src="/assets/trash.svg"
                                alt=""
                                style="margin-right: 0 !important"
                            />
                            <i class="fas fa-chevron-down drop-arrow"></i>
                            <i class="fas fa-chevron-up drop-arrow"></i>
                        </div>
                    </div>
                    <div class="list-single-drop">
                        <div>{{ member.email }}</div>
                        <div>{{ member.mobile }}</div>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit member</h4>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                &times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <input
                                type="hidden"
                                disabled
                                class="form-control"
                                id="e_id"
                                name="id"
                                required
                                :value="this.e_id"
                            />
                            Name:
                            <input
                                type="text"
                                class="form-control"
                                id="e_name"
                                name="name"
                                required
                                :value="this.e_name"
                            />
                            Email:
                            <input
                                type="text"
                                class="form-control"
                                id="e_email"
                                name="email"
                                required
                                :value="this.e_email"
                            />
                            Mobile:
                            <input
                                type="number"
                                class="form-control"
                                id="e_mobile"
                                name="mobile"
                                required
                                :value="this.e_mobile"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="10"
                                @keydown="numberRistrict()"
                            />
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-sm wed-btn-main close"
                                @click="updateMember()"
                                data-dismiss="modal"
                            >
                                <span class="material-icons">save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="message"
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
import Multiselect from "vue-multiselect";

export default {
    props: ["hostId", "membersList", "invitation", "departments", "leaders"],
    components: {
        Multiselect,
    },
    data() {
        return {
            editing: false,
            newMember: {
                invitation_id: this.invitation.id,
                leader_id: null,
                departnment_id: null,
                leader: 'false',
            },
            departmentList: this.departments,
            leaderList: this.leaders,
            hasError: false,
            errMessage: "",
            members: this.membersList,
            e_id: "",
            e_name: "",
            e_email: "",
            e_mobile: "",
            errors: null,
            showForm: false,
            message: null,
            success: false,
        };
    },
    mounted() {
        this.$nextTick(function () {
            //this.getMembers();
        });
    },

    methods: {
        addTag(tag){
            console.log(tag);
            this.departmentList.push({'name' : tag});
            this.newMember.departnment_id = {'name' : tag};
        },
        doEdit(editing) {
            this.editing = editing;
            this.errMessage = "";
            this.hasError = false;
            this.errors = null;
            this.newMember = {
                invitation_id: this.invitation.id,
                leader_id: null,
                departnment_id: null,
                leader: false,
            };
            this.e_id = null;
            this.showForm = false;
        },
        createMember() {
            var input = this.newMember;
            let slug;
            if (input.name == "") {
                slug =
                    input.name.toLowerCase() +
                    "-" +
                    Math.floor(Math.random() * 100 + 1);
            }
            const host_id = this.hostId;
            var input = { ...input, host_id, slug };
            var _this = this;
            let exists = null;
            console.log(input);
            this.members.forEach(function (item) {
                if (
                    input["name"] == null ||
                    input["email"] == null ||
                    input["mobile"] == null
                ) {
                    //console.log("All Feilds are Reqiured");
                    _this.errMessage = "All Feilds are Reqiured";
                    exists = 0;
                    return;
                }
                if (item.email == input["email"]) {
                    //console.log("Email Address Exists");
                    _this.errMessage = "Email Address Exists";
                    exists = 0;
                    return;
                }
                if (item.mobile == input["mobile"]) {
                    //console.log("Mobile Number Exists");
                    _this.errMessage = "Mobile Number Exists";
                    exists = 0;
                    return;
                }
            });

            if (exists == 0) {
                this.hasError = true;
            } else {
                axios
                    .post("/storemember", input)
                    .then(function (response) {
                        _this.hasError = false;
                        _this.members = response.data.members;
                        _this.leaderList = response.data.leaders;
                        _this.departmentList = response.data.departments;
                        _this.editing = false;
                        _this.message = response.data.flash;
                    })
                    .catch((error) => {
                        _this.errors = error.response.data.errors;
                        _this.message = error.response.data.flash;
                    });
            }
        },
        // getMembers() {
        //     var _this = this;
        //     axios
        //         .get("/getmembers")
        //         .then(function (response) {
        //             _this.members = response.data;
        //             if (_this.members.length == 0) {
        //                 //console.log(this.members.length);
        //                 _this.doEdit(true);
        //             }
        //         })
        //         .catch((error) => {
        //             console.log("Get All: " + error);
        //         });
        // },
        deleteMember(member) {
            var _this = this;
            axios
                .post("/deletemembers/" + member.id)
                .then(function (response) {
                    console.log(response);
                    _this.getMembers();
                })
                .catch((error) => {
                    console.log("Delete member: " + error);
                });
        },
        setVal(member) {
            this.doEdit(true);
            this.e_id = member.id;
            this.newMember.name = member.name;
            (this.newMember.email = member.email),
            (this.newMember.mobile = member.mobile);
            this.newMember.departnment_id = member?.deptartment;
            this.newMember.leader = member?.pivot?.is_leader;
            this.newMember.leader_id = member?.leaderId;
            this.showForm = true;
        },
        updateMember() {
            var _this = this;
            _this.errors = null;
            var id_val_1 = this.e_id;
            var input = this.newMember;
            let slug;
            if (input.name == "") {
                slug =
                    input.name.toLowerCase() +
                    "-" +
                    Math.floor(Math.random() * 100 + 1);
            }
            const host_id = this.hostId;
            var input = { ...input, host_id, slug };
            var _this = this;
            let exists = null;
            console.log(input);
            if (exists == 0) {
                this.hasError = true;
            }else {
                axios
                .post(
                    "/updatemembers/" + id_val_1,
                    input,
                    {
                        headers: {
                            "Content-Type": "application/json",
                            // Authorization: 'Bearer ' + varToken
                        },
                    }
                )
                .then((response) => {
                    _this.hasError = false;
                    _this.members = response.data.members;
                    _this.leaderList = response.data.leaders;
                    _this.departmentList = response.data.departments;
                    _this.editing = false;
                    _this.message = response.data.flash;
                })
                .catch((error) => {
                    _this.errors = error.response.data.errors;
                    _this.message = error.response.data.flash;
                });
            }
        },
        numberRistrict() {
            [...document.querySelectorAll('input[type="number"]')].forEach(
                function (item) {
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
                }
            );
        },
        toggle(e) {
            //console.log(screen.width);
            if (screen.width <= 968) {
                let currEle = e.currentTarget;
                let all = [
                    ...document.getElementsByClassName("member-list-single"),
                ];
                if (currEle.classList.contains("active")) {
                    currEle.classList.remove("active");
                    return;
                }
                all.forEach(function (item) {
                    if (item.classList.contains("active")) {
                        item.classList.remove("active");
                    }
                });

                currEle.classList.add("active");
            }
        },
    },
    computed: {
        reversedMembers() {
            return [...this.members].reverse().sort();
        },
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
.support-memebers-title {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    text-align: center;
    color: #333333;
    position: relative;
    padding: 9px 15px 13px;
}
.support-memebers-title > img {
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 9px 15px 13px;
    position: absolute;
    right: 22%;
    top: 5%;
    cursor: pointer;
}
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
}
.member-list-single {
    border: 0.5px solid #d2d2d2;
    border-radius: 6px;
    padding: 12px 22px;
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}
.member-list-single > div {
    flex: 1;
}
.list-single-name {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 22px;

    color: #000000;
}
.list-single-email {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 15px;
    line-height: 22px;
    color: #7b7b7b;
}
.member-list-single > div:nth-child(3) {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.member-list-single > div:nth-child(3) img {
    width: 37px;
    height: 32px;
    margin-right: 5px;
    cursor: pointer;
}

.form-group-custom > label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 12px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom > input {
    background: rgba(239, 220, 226, 0.2);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
}
.form-group-custom > input::placeholder {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom > button {
    background: #c4456f;
    border-radius: 7.72px;
    width: 100%;
    display: inline-block;
    padding: 11px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;
    /* identical to box height */

    text-align: center;
    box-shadow: none !important;
    color: #ffffff;
}
.form-row {
    width: 50%;
    margin: auto;
}
.drop-arrow {
    display: none;
    margin-left: 15px;
}
.list-single-drop {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    /* identical to box height */
    width: 100%;
    display: none;
    color: #7b7b7b;
}
.list-single-email > div:nth-child(2) {
    display: flex;
    align-items: center;
}

.member-list-single.active > .list-single-drop {
    display: block !important;
}

@media only screen and (max-width: 996px) {
    .member-list-single > div:nth-child(2) {
        display: none;
    }
    .member-list-single > div:nth-child(3) > div:nth-child(1) {
        display: none;
    }
    .member-list-single {
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .member-list-single > div {
        flex: none;
    }
    .list-single-email img {
        width: 25px;
        height: 25px;
    }
    .member-list-single .fa-chevron-down.drop-arrow {
        display: block;
    }
    .member-list-single .fa-chevron-up.up-arrow {
        display: none;
    }
    .member-list-single.active .fa-chevron-down.drop-arrow {
        display: none;
    }
    .member-list-single.active .fa-chevron-up.drop-arrow {
        display: block;
    }
    .form-row {
        width: 100%;
    }
    .support-memebers-title > img {
        right: 0;
    }
}
</style>
