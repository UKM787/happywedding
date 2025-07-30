<template>
    <div class="testi-popup-cont">
            <div class="testi-form-cont">
                <div class="testi-form-head">
                    <div>
                        <span>{{selectedForm.heading}}</span>
                        <span></span>
                    </div>
                    <img style="cursor: pointer;" @click="$emit('close')" src="/assets/clarity_window-close-line.svg" alt="">
                </div>
                <p class="testi-form-que mt-3">Your venue <span>Details:</span></p>
                <div v-if="edit == true">
                    <div class="form-group">
                        <div class="multi-select" style="padding: 14px 20px">
                            <multiselect
                                v-model="selectedEdit"
                                placeholder="Select Venue"
                                :options="hostvenues"
                                :show-labels="false"
                                :allow-empty="false"
                                @select="selectVModel"
                                track-by="name"
                                label="name"
                                ><span slot="noResult">No Venue Exists.</span>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="mb-3">
                        <input type="text" v-model="venueDetails.name" name="address" id="name" placeholder="Venue Name"></input>
                        <span
                            v-if="errorsSubmit && errorsSubmit.name"
                            class="errMsg"
                            >{{ errorsSubmit.name[0] }}</span
                        >
                    </div>
                    <textarea v-model="venueDetails.address" name="address" id="address" cols="30" rows="3" placeholder="Venue Address"></textarea>
                    <span
                        v-if="errorsSubmit && errorsSubmit.address"
                        class="errMsg"
                        >{{ errorsSubmit.address[0] }}</span
                    >
                    <div class="d-flex justify-end"><button type="button" @click="addVenue()" :disabled="disableSubmit">{{selectedForm.buttonText}}</button></div>
                    <div v-if="edit == false" class="d-flex justify-end"><button type="button" @click="edit = true; selectedForm.heading = 'Edit'">{{editBtn}}</button></div>
                    <div v-else class="d-flex justify-end"><button type="button" @click="undoEdit()">Add New Venue</button></div>
                    
                </form>
            </div>
        </div>
</template>
<script>
import Multiselect from "vue-multiselect";

    export default {
        props: ['hostvenues', 'selectedState', 'selectedCity'],
        components: {
            Multiselect,
        },
        emits: ['close', 'venue', 'message', 'all'],
        data() {
            return {
                selectedForm: {
                    heading: 'Add Your Venue',
                    buttonText: 'Submit',
                },
                venueDetails: {
                    name: null,
                    address: null,
                },
                disableSubmit: false,
                errorsSubmit: null,
                editBtn: 'Edit Existing Venues',
                edit: false,
                editId: null,
                selectedEdit: null,
            }
        },
        methods: {
            addVenue(){
                let _this = this;
                _this.disableSubmit = true;
                _this.errorsSubmit = null;

                // Debug: Log selected state and city
                console.log('Selected State:', _this.selectedState);
                console.log('Selected City:', _this.selectedCity);

                // Validate form data
                if (!_this.venueDetails.name || !_this.venueDetails.address) {
                    _this.errorsSubmit = {
                        general: ['Please fill in all required fields']
                    };
                    _this.disableSubmit = false;
                    return;
                }

                let formData = new FormData();
                formData.append('name', _this.venueDetails.name);
                formData.append('address', _this.venueDetails.address);

                // Add selected state and city information
                if (_this.selectedState) {
                    console.log('Adding state:', _this.selectedState.name);
                    formData.append('state', _this.selectedState.name);
                }
                if (_this.selectedCity) {
                    console.log('Adding city with location_id:', _this.selectedCity.code);
                    formData.append('location_id', _this.selectedCity.code);
                }

                let link = "/api/host/hostvenues";
                let meth = "POST";
                if(this.edit == true){
                    link = `/api/host/hostvenues/${this.editId}`;
                    formData.append("_method", "PATCH");
                }

                axios({
                    method: meth,
                    url: link,
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then((response) => {
                        _this.disableSubmit = false;
                        console.log('Response:', response);

                        if (!response.data.success) {
                            _this.errorsSubmit = {
                                general: [response.data.message]
                            };
                            return;
                        }

                        // Handle successful response
                        if (response.data.venue) {
                            let ele = {
                                'name': response.data.venue.name,
                                'code': response.data.venue.id
                            };
                            
                            _this.$emit('message', response.data.message);
                            if(_this.edit == true){
                                _this.$emit('venue', [ele, 'update']);
                            } else {
                                _this.$emit('venue', [ele, 'add']);
                            }
                            
                            // Reset form and close
                            _this.venueDetails.name = '';
                            _this.venueDetails.address = '';
                            _this.$emit('close');
                            _this.undoEdit();
                        } else {
                            // Handle error response
                            _this.errorsSubmit = {
                                general: [response.data.message || 'Failed to add venue. Please try again.']
                            };
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        _this.disableSubmit = false;
                        
                        if (error.response) {
                            // Server responded with error
                            if (error.response.data && error.response.data.errors) {
                                _this.errorsSubmit = error.response.data.errors;
                            } else {
                                _this.errorsSubmit = {
                                    general: [error.response.data.message || 'Server error occurred']
                                };
                            }
                        } else if (error.request) {
                            // Request made but no response
                            _this.errorsSubmit = {
                                general: ['No response from server. Please try again.']
                            };
                        } else {
                            // Something else went wrong
                            _this.errorsSubmit = {
                                general: ['An error occurred. Please try again.']
                            };
                        }
                    });
            },
            selectVModel(selectedOption, id){
                this.editId = selectedOption.id;
                this.selectedForm.heading  = 'Edit ' + selectedOption.name;
                this.selectedForm.buttonText  = 'Update'; 
                this.editBtn = 'Add New Venue'
                this.venueDetails.name = selectedOption.name;
                this.venueDetails.address = selectedOption.address;
            },
            undoEdit(){
                this.editId = null;
                this.selectedForm.heading  = 'Add Your Venue';
                this.selectedForm.buttonText  = 'Submit'; 
                this.venueDetails.name = null;
                this.venueDetails.address = null;
                this.edit = false;
                this.selectedEdit = false;
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
.testi-popup-cont{
    width: 100%;
    height: 100%;
    position: fixed;
    background: rgba(0, 0, 0, 0.50);
    z-index: 999999999999999;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.testi-form-cont{
    border-radius: 8.388px;
    background: #FFF;
    box-shadow: 0px 3.35501px 50.3252px 0px rgba(0, 0, 0, 0.25);
    width: 100%;
    padding: 30px;
    max-width: 620px;
}
.testi-form-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.testi-form-head  > div {
    color: #000;
    font-family: Poppins;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    display: flex;
    flex-direction: column;
}
.testi-form-head  > div > span:nth-child(2){
    margin-top: 5px;
    display: block;
    width: 45px;
    height: 6px;
    background: #C4456F;
}
.testi-form-que{
    color: #000;
    font-family: Poppins;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.testi-form-que > span{
    font-weight: 600;
}
.testi-form-cont textarea, .testi-form-cont input {
    border-radius: 7px;
    border: 0.8px solid #A4A4A4;
    padding: 10px;
    background-color: white !important;
    width: 100%;
    color: #898989;
    font-family: Poppins;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: 165%;
}
/* .testi-form-cont input{
    padding: 10px;
} */
.testi-form-cont textarea:hover{
    background-color: white !important;
}
.testi-form-cont > form  button{
    border:none;
    outline: none;
    margin-bottom: 10px;
    border-radius: 11px;
    background: #461952;
    padding: 18px 33px;
    color: #FFF;
    font-family: Mulish;
    font-size: 12.581px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
    display: inline-block;
    margin-left: auto;
}
</style>