<template>
    <div>
        <div v-if="showForm" class="overlay-form">
            <form @submit.prevent="submit($event)" class="task-form-emp">
                <div class="d-flex justify-content-end">
                    <i
                        @click="showForm = false"
                        style="font-size: 30px; cursor: pointer"
                        class="fas fa-times-circle"
                    ></i>
                </div>
                <div class="cont-around">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input
                            type="date"
                            class="form-control"
                            id="date"
                            v-model="submitForm.date"
                        />
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <input
                            type="number"
                            class="form-control"
                            id="priority"
                            v-model="submitForm.priority"
                        />
                    </div>
                </div>
                <div class="cont-around">
                    <div class="form-group">
                        <label for="page_name">Page Name/Path</label>
                        <input
                            type="text"
                            class="form-control"
                            id="page_name"
                            v-model="submitForm.page_name"
                        />
                    </div>
                    <div class="form-group">
                        <label for="web_url">Web URL</label>
                        <input
                            type="text"
                            class="form-control"
                            id="web_url"
                            v-model="submitForm.web_url"
                        />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Challanges">Challanges</label>
                    <textarea
                        class="form-control"
                        id="Challanges"
                        rows="3"
                        v-model="submitForm.challanges"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="Recommendation">Recommendations</label>
                    <textarea
                        class="form-control"
                        id="Recommendation"
                        rows="3"
                        v-model="submitForm.recommendation"
                    ></textarea>
                </div>
                <div class="cont-around multiple_cont">
                    <div class="form-group">
                        <label for="assigned_to">Assigned To</label>
                        <input
                            type="text"
                            class="form-control"
                            id="assigned_to"
                            v-model="submitForm.assigned_to"
                        />
                    </div>
                    <div class="form-group">
                        <label for="reported_by">Reported By</label>
                        <input
                            type="text"
                            class="form-control"
                            id="reported_by"
                            v-model="submitForm.reported_by"
                        />
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select
                            size="2"
                            class="form-control"
                            id="status"
                            v-model="submitForm.status"
                        >
                            <option>Pending</option>
                            <option>Done</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Remarks">Remarks</label>
                    <textarea
                        class="form-control"
                        id="Remarks"
                        rows="3"
                        v-model="submitForm.remarks"
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2 btn-custm">
                    Save
                </button>
            </form>
        </div>
        <div class="container position-relative">
            <div class="site-tasks-head">
                <button type="button" @click="formShow()">Add Tasks</button>
                <p>List of Site Tasks</p>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Page Name/Path</th>
                        <th scope="col">Web URL</th>
                        <th scope="col">Challanges</th>
                        <th scope="col">Recommendations</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Reported By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in allTasks" :key="index">
                        <th scope="row">{{ index }}</th>
                        <td>{{ item.date }}</td>
                        <td>{{ item.priority }}</td>
                        <td>{{ item.page_name }}</td>
                        <td>{{ item.web_url }}</td>
                        <td>{{ item.challanges }}</td>
                        <td>{{ item.recommendation }}</td>
                        <td>{{ item.assigned_to }}</td>
                        <td>{{ item.reported_by }}</td>
                        <td>{{ item.status }}</td>
                        <td>{{ item.remarks }}</td>
                        <td class="edit-btn-tab">
                            <button
                                @click="editForm($event, index)"
                                type="button"
                            >
                                <i class="fas fa-edit"></i></button
                            ><button @click="deleteitem(item.id)" type="button">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    data() {
        return {
            submitForm: {
                date: null,
                priority: null,
                page_name: null,
                web_url: null,
                challanges: null,
                recommendation: null,
                assigned_to: null,
                reported_by: null,
                status: null,
                remarks: null,
            },
            allTasks: [],
            showForm: false,
            updateForm: false,
            updateId: null,
            message: null,
        };
    },
    methods: {
        submit(e) {
            let _this = this;
            let formData = new FormData();
            let data = JSON.stringify(_this.submitForm);
            formData.append("data", data);
            console.log(formData, data);
            let url = "/api/sitetasks";
            if (_this.updateForm == true) {
                url = `/api/sitetasks/${_this.updateId}`;
                formData.append("_method", "PATCH");
            }

            axios
                .post(url, formData)
                .then(function (response) {
                    for (const key in _this.submitForm) {
                        _this.submitForm[key] = null;
                    }
                    _this.showForm = false;
                    if (_this.updateForm == true) {
                        _this.message = "UPDATED!!";
                    } else {
                        _this.message = "Submitted!!";
                    }
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.updateForm = false;
                    _this.updateId = null;
                    _this.getTasks();
                    console.log(response);
                })
                .catch((error) => {
                    _this.message = "Something went wrong!!";
                    console.log(error);
                });
        },
        getTasks() {
            let _this = this;
            axios
                .get("/api/sitetasks")
                .then(function (response) {
                    _this.allTasks = response.data;
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editForm(e, i) {
            let _this = this;
            _this.updateId = _this.allTasks[i].id;
            _this.submitForm = _this.allTasks[i];
            delete _this.submitForm.id;
            delete _this.submitForm.updated_at;
            delete _this.submitForm.created_at;
            delete _this.submitForm.slug;
            _this.updateForm = true;
            _this.showForm = true;
        },
        formShow() {
            let _this = this;
            _this.submitForm = {
                date: null,
                priority: null,
                page_name: null,
                web_url: null,
                challanges: null,
                recommendation: null,
                assigned_to: null,
                status: null,
                remarks: null,
            };
            _this.showForm = true;
        },
        deleteitem(i) {
            if (confirm("Are you sure you want to delete?")) {
                let _this = this;
                axios
                    .delete(`api/sitetasks/${i}`)
                    .then(function (response) {
                        _this.message = "Deleted";
                        _this.getTasks();
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        console.log(error);
                        _this.message = "Spmething went wrong!!";
                    });
            } else {
                // Do nothing!
                return;
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            //console.log(this.vendorCat, this.vendor);
            this.getTasks();
        });
    },
};
</script>

<style scoped>
.task-form-emp {
    width: 60%;
    background-color: #fafafa;
    margin: 4em auto;
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
.site-tasks-head > button {
    background-color: #461952;
    color: white;
    outline: none;
    border: none;
    padding: 5px 15px;
    border-radius: 10px;
}
.site-tasks-head > p {
    font-family: "Lato", sans-serif;
    font-style: normal;
    font-weight: 700;
    font-size: 36px;
    line-height: 43px;
    text-align: center;
    color: #461952;
    width: 100%;
}
.overlay-form {
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
}
</style>
