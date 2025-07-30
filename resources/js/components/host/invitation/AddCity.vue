
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
            <p class="testi-form-que mt-3">Your city <span>Details:</span></p>
            <div v-if="edit == true">
                <div class="form-group">
                    <div class="multi-select" style="padding: 14px 20px">
                        <multiselect
                            v-model="selectedEdit"
                            placeholder="Select City"
                            :options="locations"
                            :show-labels="false"
                            :allow-empty="false"
                            @select="selectCityModel"
                            track-by="name"
                            label="name"
                            ><span slot="noResult">No city exists.</span>
                        </multiselect>
                    </div>
                </div>
            </div>
            <form>
                <div class="mb-3">
                    <input type="text" v-model="cityDetails.name" name="name" id="name" placeholder="City Name"></input>
                    <span
                        v-if="errorsSubmit && errorsSubmit.name"
                        class="errMsg"
                        >{{ errorsSubmit.name[0] }}</span
                    >
                </div>
                <div class="mb-3">
                    <input type="text" v-model="cityDetails.state" name="state" id="state" placeholder="State"></input>
                    <span
                        v-if="errorsSubmit && errorsSubmit.state"
                        class="errMsg"
                        >{{ errorsSubmit.state[0] }}</span
                    >
                </div>
                <div class="d-flex justify-end"><button type="button" @click="addCity()" :disabled="disableSubmit">{{selectedForm.buttonText}}</button></div>
                <div v-if="edit == false" class="d-flex justify-end"><button type="button" @click="edit = true; selectedForm.heading = 'Edit'">{{editBtn}}</button></div>
                <div v-else class="d-flex justify-end"><button type="button" @click="undoEdit()">Add New City</button></div>
            </form>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
    props: ['locations'],
    components: {
        Multiselect,
    },
    emits: ['close', 'city', 'message', 'all'],
    data() {
        return {
            selectedForm: {
                heading: 'Add Your City',
                buttonText: 'Submit',
            },
            cityDetails: {
                name: null,
                state: null,
            },
            disableSubmit: false,
            errorsSubmit: null,
            editBtn: 'Edit Existing Cities',
            edit: false,
            editId: null,
            selectedEdit: null,
        }
    },
    methods: {
        selectCityModel(n) {
            this.cityDetails.name = n.name;
            this.cityDetails.state = n.state || '';
            this.editId = n.code;
        },
        undoEdit() {
            this.edit = false;
            this.selectedForm.heading = 'Add Your City';
            this.cityDetails = {
                name: null,
                state: null,
            };
            this.selectedEdit = null;
        },
        addCity() {
            let _this = this;
            _this.disableSubmit = true;
            _this.errorsSubmit = null;
            
            // Validate inputs
            if (!_this.cityDetails.name || !_this.cityDetails.state) {
                _this.errorsSubmit = {
                    name: ['City name is required'],
                    state: ['State is required']
                };
                _this.disableSubmit = false;
                return;
            }
            
            let formData = new FormData();
            formData.append('name', _this.cityDetails.name);
            formData.append('state', _this.cityDetails.state);
            
            // Log what we're sending
            console.log('Sending data:', {
                name: _this.cityDetails.name,
                state: _this.cityDetails.state
            });
            
            let url = '/api/host/cities';
            let method = 'POST';
            
            if (_this.edit == true) {
                url = `/api/host/cities/${_this.editId}`;
                method = 'PUT';
            }
            
            axios({
                method: method,
                url: url,
                data: formData,
                headers: { 
                    'Content-Type': 'multipart/form-data',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then((response) => {
                console.log('Success response:', response.data);
                _this.disableSubmit = false;
                _this.message = response.data.message;
                
                if (_this.edit == true) {
                    let updatedCity = {
                        name: _this.cityDetails.name,
                        state: _this.cityDetails.state,
                        code: _this.editId
                    };
                    _this.$emit('city', [updatedCity, 'update']);
                } else {
                    let newCity = {
                        name: _this.cityDetails.name,
                        state: _this.cityDetails.state,
                        code: response.data.data.id
                    };
                    _this.$emit('city', [newCity, 'add']);
                }
                
                _this.$emit('message', response.data.message);
                _this.$emit('all', response.data.all || _this.locations);
                _this.$emit('close');
            })
            .catch((error) => {
                _this.disableSubmit = false;
                console.error('Error:', error);
                console.error('Error response:', error.response);
                
                if (error.response && error.response.data) {
                    console.error('Error data:', error.response.data);
                    _this.errorsSubmit = error.response.data.errors;
                    _this.$emit('message', error.response.data.message || 'Error adding city');
                } else {
                    _this.$emit('message', 'Network error. Please try again.');
                }
            });
        }
    }
}
</script>

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
.testi-form-head > div {
    color: #000;
    font-family: Poppins;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    display: flex;
    flex-direction: column;
}
.testi-form-head > div > span:nth-child(2){
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
.testi-form-cont textarea:hover, .testi-form-cont input:hover{
    background-color: white !important;
}
.testi-form-cont > form button{
    border: none;
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
.errMsg {
    color: red;
    font-size: 12px;
    display: block;
    margin-top: 5px;
}
.justify-end {
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}
.multi-select {
    border-radius: 7px;
    border: 0.8px solid #A4A4A4;
    background-color: white !important;
}
</style>



