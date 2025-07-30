<template>
    <div class="testi-popup-cont">
            <div class="testi-form-cont">
                <div class="testi-form-head">
                    <div>
                        <span>Assign to a Member</span>
                        <span></span>
                    </div>
                    <img style="cursor: pointer;" @click="$emit('close')" src="/assets/clarity_window-close-line.svg" alt="">
                </div>
                <p class="testi-form-que mt-3">Your members <span>List:</span></p>
                <form>
                    <div class="mb-3">
                        <multiselect
                                v-model="selectedEdit"
                                placeholder="Select Member"
                                :options="members"
                                :show-labels="false"
                                :allow-empty="false"
                                track-by="name"
                                label="name"
                                ><span slot="noResult">No Member Exists.</span>

                            </multiselect>
                    </div>
                    <div class="d-flex justify-end"><button type="button" @click="addVenue()" :disabled="disableSubmit">Assign</button></div>                    
                </form>
            </div>
        </div>
</template>
<script>
import Multiselect from "vue-multiselect";

    export default {
        props: ['members', 'ele', 'eleIndex'],
        components: {
            Multiselect,
        },
        emits: ['close', 'message', 'sucess'],
        data() {
            return {
                disableSubmit: false,
                errorsSubmit: null,
                selectedEdit: this.ele?.assigned_to ?? null,
            }
        },
        methods: {
            addVenue(){
                let _this = this;
                _this.disableSubmit = true;
                _this.errorsSubmit = null;
                let formData = new FormData();
                let meth  = 'POST';
                let link = route('hosttasks.store')
                formData.append("type", 'assign');
                formData.append("id", _this.ele.pivot.id);
                formData.append("member_id", _this.selectedEdit.id);
                axios({
                    method: meth,
                    url: link,
                    data: formData,
                })
                    .then((response) => {
                        _this.$emit('message', response.data["message"]);
                        _this.$emit('sucess', response.data["data"]);
                        _this.$emit('close');
                    })
                    .catch((error) => {
                        _this.errorsSubmit = error.response.data?.errors;
                        _this.disableSubmit = false;
                        if (error.response.data["message"]) {
                            _this.$emit('message', response.data["message"]);
                        }
                    });
            },
            // selectVModel(selectedOption, id){
            //     this.editId = selectedOption.id;
            //     this.selectedForm.heading  = 'Edit ' + selectedOption.name;
            //     this.selectedForm.buttonText  = 'Update'; 
            //     this.editBtn = 'Add New Venue'
            //     this.venueDetails.name = selectedOption.name;
            //     this.venueDetails.address = selectedOption.address;
            // },
            // undoEdit(){
            //     this.editId = null;
            //     this.selectedForm.heading  = 'Add Your Venue';
            //     this.selectedForm.buttonText  = 'Submit'; 
            //     this.venueDetails.name = null;
            //     this.venueDetails.address = null;
            //     this.edit = false;
            //     this.selectedEdit = false;
            // }
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