<template>
    <div class="wed-host-section container mx-auto">
        <div class="wed-host-section-container">
            <!-- Bride and Groom Details Section -->
           
            
            <div class="help-line-head">
                <div>
                    <h3>Help Line</h3>
                    <h5
                        v-if="
                            showForm == true ||
                            contactMembers.length == 0 ||
                            edit == true
                        "
                    >
                        Add supporting members to helpline for guests to contact
                        or seek help directly to the incharge members
                    </h5>
                </div>
                <a
                    :href="route('hostmembers.index')"
                    v-if="
                        contactMembers.length == 0 ||
                        edit == true ||
                        showForm == true
                    "
                >
                    <img src="/assets/user-plus.svg" alt="" />
                </a>
                <button @click="showForm = true" v-else>
                    <span>+</span>Add Help line
                </button>
            </div>
            <div
                v-if="
                    contactMembers.length == 0 ||
                    edit == true ||
                    showForm == true
                "
                class="help-line-add-form"
            >
                <form @submit.prevent="submitForm" class="form-row">
                    <div class="form-group-custom">
                        <label for="name" class="form-label">For</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            required
                            placeholder="Name"
                            name="name"
                            v-model="formValues.contact_for"
                        />
                        <span
                            v-if="errorSubmit && errorSubmit.contact_for"
                            class="errMsg"
                            >{{ errorSubmit.contact_for[0] }}</span
                        >
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label">Name</label>
                        <select
                            name="category_id"
                            class="form-control"
                            v-model="formValues.host_id"
                        >
                            <option
                                v-for="(item, id) in members"
                                :key="id"
                                :value="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>
                        <span
                            v-if="errorSubmit && errorSubmit.host_id"
                            class="errMsg"
                            >{{ errorSubmit.host_id[0] }}</span
                        >
                    </div>
                    <div class="form-group-custom" style="text-align: right">
                        <button
                            v-if="contactMembers.length > 0"
                            @click="closeForm"
                            type="button"
                            class="btn btn-sm close"
                        >
                            <span>Close</span>
                        </button>
                        <button
                            :disabled="disableForm"
                            type="submit"
                            class="btn btn-sm"
                        >
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
            <div v-else class="help-line-list-cont">
                <div
                    v-for="(item, index) in contactMembers"
                    :key="index"
                    class="help-line-list-single"
                    @click="toggle($event)"
                >
                    <span style="width: 20%">{{ item.contact_for }}</span>
                    <span style="width: 17%" class="black">{{
                        item.member.name
                    }}</span>
                    <span style="width: 30%" class="light">{{
                        item.member.email
                    }}</span>
                    <span style="width: 15%" class="light">{{
                        item.member.mobile
                    }}</span>
                    <span style="text-align: right; width: 13%">
                        <img
                            v-if="item.contact_for !== 'Bride' && item.contact_for !== 'Groom'"
                            @click="
                                editForm(
                                    item.contact_for,
                                    item.host_id,
                                    item.id
                                )
                            "
                            src="/assets/edit.svg"
                            alt=""
                        />
                        <img
                            v-if="item.contact_for !== 'Bride' && item.contact_for !== 'Groom'"
                            @click="deleteHelpline(item.id)"
                            src="/assets/trash.svg"
                            alt=""
                        />
                    </span>
                    <span
                        ><i class="fas fa-chevron-down drop-arrow"></i>
                        <i class="fas fa-chevron-up drop-arrow"></i
                    ></span>
                </div>
            </div>
            <flashMessage :message="message"></flashMessage>
        </div>
    </div>
</template>

<script>
import flashMessage from "../../../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["host", "invitation", "members", "contactList"],
    data() {
        return {
            formValues: {
                contact_for: null,
                host_id: null,
            },
            disableForm: false,
            edit: false,
            contactMembers: this.contactList ?? [],
            errorSubmit: false,
            showForm: false,
            updateId: null,
            message: null,
        };
    },
    mounted() {
        // Log the invitation data for debugging
        console.log('HelpLine - Invitation data:', this.invitation);
        
        // Add bride and groom to contact members
        this.addCoupleToContactMembers();
    },
    methods: {
        addCoupleToContactMembers() {
            if (this.invitation) {
                // Create a copy of the contact members array
                let updatedMembers = [...this.contactMembers];
                
                // Check if bride details exist
                if (this.invitation.brideName) {
                    // Check if bride is already in the list
                    const brideExists = updatedMembers.some(member => member.contact_for === 'Bride');
                    if (!brideExists) {
                        // Add bride to the list
                        updatedMembers.push({
                            contact_for: 'Bride',
                            member: {
                                name: this.invitation.brideName,
                                email: this.invitation.brideEmail || '',
                                mobile: this.invitation.brideMobile || '',
                            }
                        });
                    }
                }
                
                // Check if groom details exist
                if (this.invitation.groomName) {
                    // Check if groom is already in the list
                    const groomExists = updatedMembers.some(member => member.contact_for === 'Groom');
                    if (!groomExists) {
                        // Add groom to the list
                        updatedMembers.push({
                            contact_for: 'Groom',
                            member: {
                                name: this.invitation.groomName,
                                email: this.invitation.groomEmail || '',
                                mobile: this.invitation.groomMobile || '',
                            }
                        });
                    }
                }
                
                // Update contact members
                this.contactMembers = updatedMembers;
            }
        },
        submitForm() {
            //console.log(invalid);
            let _this = this;
            _this.disableForm = true;
            let meth = "POST";
            let link = route(
                "hostinvitationcontact.store",
                _this.invitation.slug
            );
            if (_this.edit == true) {
                meth = "PATCH";
                link = route("hostinvitationcontact.update", [
                    _this.invitation.slug,
                    _this.updateId,
                ]);
            }
            axios({
                method: meth,
                url: link,
                data: _this.formValues,
            })
                .then(function (response) {
                    _this.edit = false;
                    _this.showForm = false;
                    _this.disableForm = false;
                    _this.formValues = {};
                    _this.contactMembers = response.data;
                    
                    // Add bride and groom to contact members
                    _this.addCoupleToContactMembers();
                    
                    _this.message = "Helpline Member added!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disableForm = false;
                    _this.errorSubmit = error.response.data.errors;
                    if (_this.errorSubmit) {
                        _this.message = "Kindly correct the feilds!";
                    } else {
                        _this.message = "Please try again later!";
                    }
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        editForm(val, host, member) {
            this.formValues = {
                contact_for: val,
                host_id: host,
            };
            this.updateId = member;
            this.edit = true;
            this.showForm = true;
        },
        closeForm() {
            this.showForm = false;
            this.edit = false;
            this.formValues = {};
            this.updateId = null;
        },
        deleteHelpline(id) {
            let _this = this;
            axios({
                method: "DELETE",
                url: route("hostinvitationcontact.destroy", [
                    _this.invitation,
                    id,
                ]),
            })
                .then(function (response) {
                    _this.contactMembers = response.data;
                    _this.message = "Member Deleted!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disableForm = false;
                    _this.errorSubmit = error.response.data.errors;

                    _this.message = "Please try again later!";
                });
        },
        toggle(e) {
            //console.log(screen.width);
            if (screen.width <= 968) {
                let currEle = e.currentTarget;
                let all = document.getElementsByClassName(
                    "help-line-list-single"
                );
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
    watch: {
        // Watch for changes in the invitation prop
        invitation: {
            handler() {
                this.addCoupleToContactMembers();
            },
            deep: true
        }
    }
};
</script>

<style scoped>
.errMsg {
    color: red;
    font-size: 10px;
}
.help-line-head {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}
.help-line-head h3 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    text-align: center;
    color: #333333;
    margin-bottom: 22px;
}
.help-line-head h5 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #000000;
}
.help-line-list-cont {
    margin-top: 15px;
}
.help-line-head > button,
a {
    outline: none;
    border: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.4286px;
    line-height: 17px;
    color: #000000;
    padding: 14px 20px;
    position: absolute;
    right: 0;
    top: 0;
    border: 1.14286px solid #e3e8ee;
    border-radius: 5.71429px;
    background-color: white;
}
.help-line-list-single {
    border: 0.5px solid #d2d2d2;
    border-radius: 6px;
    padding: 17px 25px;
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}
.help-line-list-single > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: #c4456f;
    margin-right: 5px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    display: block;
    margin-bottom: 5px;
}
.black {
    color: #000000 !important;
}
.light {
    font-weight: 300 !important;
    color: #7b7b7b !important;
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
.form-group-custom > input,
.form-group-custom > select {
    background: rgba(239, 220, 226, 0.2);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
}
.form-group-custom > select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url(/assets/icon-down.svg);
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
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
    display: inline-block;
    padding: 11px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;
    display: inline-block;
    min-width: 104px;
    text-align: center;
    box-shadow: none !important;
    color: #ffffff;
}
.close {
    color: #828282 !important;
    background: white !important;
    border: 0.5px solid #afa5a5;
}
.drop-arrow {
    display: none;
    text-align: right;
}
.form-row {
    width: 60%;
    margin: auto;
}
@media only screen and (max-width: 996px) {
    .form-row {
        width: 100% !important;
    }
    .help-line-list-single .fa-chevron-down.drop-arrow {
        display: block;
    }
    .help-line-list-single.active .fa-chevron-down.drop-arrow {
        display: none;
    }
    .help-line-list-single.active .fa-chevron-up.drop-arrow {
        display: block;
    }
    .help-line-list-single {
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .help-line-list-single > span:nth-child(1) {
        width: 42% !important;
        order: 1;
    }
    .help-line-list-single > span:nth-child(2) {
        width: 42% !important;
        order: 2;
        text-align: right;
    }
    .help-line-list-single > span:nth-child(6) {
        width: 6% !important;
        order: 3;
    }
    .help-line-list-single > span:nth-child(3) {
        width: 100% !important;
        order: 4;
        display: none;
    }
    .help-line-list-single > span:nth-child(4) {
        width: 45% !important;
        order: 5;
        display: none;
    }
    .help-line-list-single > span:nth-child(5) {
        width: 45% !important;
        text-align: right;
        order: 5;
        display: none;
    }
    .help-line-list-single.active > span:nth-child(3),
    .help-line-list-single.active > span:nth-child(4),
    .help-line-list-single.active > span:nth-child(5) {
        display: block !important;
    }
}

/* New styles for couple details */
.couple-details-section {
    margin-bottom: 30px;
    padding: 15px;
    background-color: #fceef2;
    border-radius: 8px;
    border: 1px solid #c4456f;
}

.couple-details-section h3 {
    font-family: "Futura Md BT";
    font-style: normal;
    font-weight: 400;
    font-size: 22px;
    line-height: 28px;
    color: #b1415e;
    margin-bottom: 15px;
    text-align: center;
}

.details-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px dashed #e9e9e9;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .label {
    font-family: "Poppins";
    font-weight: 500;
    color: #666;
    margin-right: 10px;
}

.detail-item .value {
    font-family: "Poppins";
    font-weight: 400;
    color: #333;
    text-align: right;
}
</style>
