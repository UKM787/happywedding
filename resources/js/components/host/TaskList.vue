<template>
    <div class="wed-host-section">
        <div class="wed-host-section-container" :class="{ loading: loading }">
            <div class="task-title wed-host-section-container-title">
                <button v-if="!editing" @click="doEdit(true)">
                    <span>+</span> Add new task
                </button>
            </div>
            <div class="d-flex justify-content-around">
                <div class="my-3" v-if="members.length > 0">
                    <button
                        v-if="editing"
                        @click="doEdit(false)"
                        class="btn btn-sm btn-cancel"
                        title="cancel task form"
                    >
                        Cancel
                    </button>
                    <!-- <button
                        v-else
                        @click="doEdit(true)"
                        class="btn btn-sm wed-btn-main"
                        title="add new task"
                    >
                        + add Tasks
                    </button> -->
                </div>
            </div>
            <div
                v-if="success"
                class="alert alert-success alert-dismissible fade show mt-3"
                role="alert"
            >
                Task Saved !
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="wed-host-section-container-form" v-if="editing">
                <div class="alert alert-danger" role="alert" v-if="hasError">
                    All fields are required!
                </div>

                <form class="form-row align-items-center">
                    <div class="form-group-custom">
                        <label for="title" class="form-label">New Task</label>
                        <input
                            @keyup.enter="saveTask"
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            v-model="fields.title"
                            placeholder="Add an new Task"
                        />
                        <div v-if="errors && errors.title" class="text-danger">
                            {{ errors.title[0] }}
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label">Task Category</label>
                        <select
                            name="category_id"
                            class="form-control"
                            v-model="fields.category_id"
                        >
                            <option
                                v-for="(category, id) in categories"
                                :key="id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label">Assigned To</label>
                        <div class="custom-select-box">
                            <span @click.stop="showDropdown = !showDropdown">{{
                                selectedMember?.name
                            }}</span>
                            <div v-if="showDropdown">
                                <span
                                    v-for="(mem, id) in members"
                                    :key="id"
                                    :value="mem.id"
                                    @click="
                                        showDropdown = false;
                                        selectedMember = mem;
                                        fields.member_id = mem.id;
                                    "
                                    >{{ mem.name }}
                                </span>
                            </div>
                        </div>
                        <!-- <select
                            name="member_id"
                            class="form-control"
                            v-model="fields.member_id"
                        >
                            <option
                                v-for="(mem, id) in members"
                                :key="id"
                                :value="mem.id"
                            >
                                {{ mem.name }}
                            </option>
                        </select> -->
                    </div>
                    <div
                        class="form-group-custom"
                        style="margin-bottom: 10px; margin-top: 12px"
                    >
                        <label class="form-label">Task Priority</label>
                        <br />
                        <label class="form-label-radio">
                            <input
                                type="radio"
                                class="form-radio"
                                name="taskPriority"
                                v-model="fields.taskPriority"
                                value="low"
                            />Low</label
                        >
                        <label class="form-label-radio">
                            <input
                                type="radio"
                                class="form-radio"
                                v-model="fields.taskPriority"
                                value="medium"
                            />Medium</label
                        >
                        <label class="form-label-radio">
                            <input
                                type="radio"
                                class="form-radio"
                                v-model="fields.taskPriority"
                                value="high"
                            />High</label
                        >
                    </div>
                    <div class="date-grp">
                        <div class="form-group-custom">
                            <input
                                type="text"
                                name="startDate"
                                :min="minDate"
                                v-model="fields.startDate"
                                onfocus="(this.type='date')"
                                class="form-date form-control"
                                placeholder="Task start date"
                            />
                            <div
                                v-if="errors && errors.startDate"
                                class="text-danger"
                            >
                                {{ errors.startDate[0] }}
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <input
                                type="text"
                                name="completionDate"
                                v-model="fields.completionDate"
                                onfocus="(this.type='date')"
                                class="form-date form-control"
                                placeholder="Task end date"
                            />
                            <div
                                v-if="errors && errors.completionDate"
                                class="text-danger"
                            >
                                {{ errors.completionDate[0] }}
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <input
                                type="text"
                                name="startTime"
                                v-model="fields.startTime"
                                onfocus="(this.type='time')"
                                placeholder="Task start time"
                                class="form-date form-control"
                            />
                            <div
                                v-if="errors && errors.startTime"
                                class="text-danger"
                            >
                                {{ errors.startTime[0] }}
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <input
                                type="text"
                                name="completionTime"
                                v-model="fields.completionTime"
                                onfocus="(this.type='time')"
                                class="form-date form-control"
                                placeholder="Task end time"
                            />
                            <div
                                v-if="errors && errors.completionTime"
                                class="text-danger"
                            >
                                {{ errors.completionTime[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group-custom ml-5">
                        <button
                            v-if="editForm == false"
                            @click.prevent="addNewTask"
                            class="btn wed-btn-main btn-sm"
                        >
                            Submit
                        </button>
                        <button
                            v-if="editForm == true"
                            @click.prevent="updateTask"
                            class="btn wed-btn-main btn-sm"
                        >
                            Update
                        </button>
                    </div>
                </form>
            </div>
            <div class="row mt-3" v-if="tasks.length > 0">
                <div
                    v-for="task in reversedTasks"
                    :key="task.id"
                    class="task-list-single"
                >
                    <div class="single-first-row">
                        <div>
                            <span>{{ task.category.name }}</span>
                            <span
                                >Assigned to :
                                <span style="font-weight: 900">{{
                                    task.assignable.name
                                }}</span></span
                            >
                        </div>
                        <div>
                            <span>
                                <img src="/assets/tag.svg" alt="" />
                                {{ task.taskPriority }}
                            </span>
                            <span>
                                <img
                                    @click="setVal(task)"
                                    src="/assets/edit.svg"
                                    alt=""
                                />
                                <img
                                    @click="deleteTask(task)"
                                    src="/assets/trash.svg"
                                    alt=""
                                />
                            </span>
                        </div>
                    </div>
                    <div class="single-second-row">
                        {{ task.title }}
                    </div>
                    <div class="single-third-row">
                        <div>
                            <img src="/assets/icon-calendar.svg" alt="" />
                            <span>{{ task.startDate }}&nbsp&nbsp </span> ---
                            <span>&nbsp&nbsp{{ task.completionDate }}</span>
                        </div>
                        <div>
                            <img src="/assets/icon-clock.svg" alt="" />
                            <span>{{ task.startTime }}</span> -
                            <span>{{ task.completionTime }}</span>
                        </div>
                        <div>
                            <span></span>
                            {{ task.taskStatus }}
                        </div>
                    </div>
                </div>
            </div>

            <div v-else>
                <p>
                    Nice job! You'v finished all your your assigned Tasks! add
                    Tasks
                </p>
            </div>
            <div>
                <p class="wed-host-section-container-title">Tasklist</p>
                <p class="wed-host-section-container-title">
                    {{ invitation.brideName }} weds
                    {{ invitation.groomName }} on {{ invitation.startDate }}
                </p>
            </div>
            <div class="d-flex">
                <div style="min-width:210px">
                    <ol>
                        <li
                            v-for="cat in taskCat"
                            :key="cat.id"
                            @click="filterTask(cat)"
                        >
                            {{ cat.name }}
                        </li>
                    </ol>
                </div>
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered">
                        <thead> 
                            <tr>
                                <td>Task Details</td>
                                <td>Task Timeline</td>
                                <td>Task Status</td>
                                <td>Assigned To(If Any)</td>
                                <td>Completed By</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                            v-for="(wedtasks, index) in filteredTasks"
                            :key="wedtasks.id"
                            >
                                <td>
                                    <i class="text-danger">{{
                                            wedtasks.name
                                        }}</i>
                                </td>
                                <td v-if="wedtasks.pivot.custom_timeline_id == null">{{ wedtasks.timeline.name }}</td>
                                <td v-else>{{ wedtasks?.custom_timeline?.name }}</td>
                                <td v-if="wedtasks.pivot.taskStatus == 0 || wedtasks.pivot.taskStatus == 2">To Do</td>
                                <td v-if="wedtasks.pivot.taskStatus == 1 || wedtasks.pivot.taskStatus == 3">In Process</td>
                                <td v-if="wedtasks.pivot.taskStatus == 5">On Hold</td>
                                <td v-if="wedtasks.pivot.taskStatus == 6">Completed</td>
                                <td>{{wedtasks?.assigned_to?.name }}</td>
                                <td>{{wedtasks?.completed_by?.name }}</td>
                                <td>
                                    <div v-if="wedtasks.pivot.taskStatus != 0 && wedtasks.pivot.taskStatus != 6" class="mb-2"><button type="button" class="btn btn-success" @click="changeTaskStatus('complete', wedtasks, index)">Finish</button></div>

                                    <div v-if="wedtasks.pivot.taskStatus == 0" class="mb-2"><button @click="changeTaskStatus('start', wedtasks, index)" type="button" class="btn btn-success" :disabled="errorsSubmit">Start</button></div>

                                    <!-- <div class="mb-2"><button type="button" class="btn btn-info">Response</button></div> -->

                                    <div  v-if="wedtasks.pivot.taskStatus != 6" class="mb-2"><button type="button" class="btn btn-secondary" @click="assignMemeber( wedtasks, index)">Assign</button></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <TaskPopup v-if="showPopup == true" :members="memberlistonly" @close="showPopup = false" :ele="editEle" :eleIndex="editIndex" @message="(n) => message = n" @sucess="updateTaskStatus"></TaskPopup>

    </div>
</template>

<script>
//import moment from 'moment';
import TaskPopup from "../host/taskPopup.vue"

export default {
    props: ["hostId", "invitation", "tasksall", "taskList", "taskCat", 'memberlist', 'memberlistonly'],
    components: {
        TaskPopup,
    },
    data() {
        return {
            showPopup:false,
            type: 'assign',
            editing: false,
            loading: true,
            selectedMember: null,
            fields: {
                // title:"",
                invitation_id: this.invitation.id,
                // pinned: false,
                taskPriority: "low",
                // taskStatus: "notStarted",
                // member_id: "",
                // category_id: "",
            },
            taskId: "",
            taskTitle: "",
            taskCategory: "",
            taskMember: "",
            taskPriority: "",
            taskDueDate: "",
            taskStatus: "",
            errors: {},
            success: false,
            loaded: true,
            hasError: false,
            tasks: this.tasksall,
            members: this.memberlist,
            categories: [],
            image_srcs: "/assets/frame881.png",
            editForm: false,
            showDropdown: false,
            filteredTasks: this.taskList,
            disableSubmit: false,
            errorsSubmit: null,
            editEle: null,
            editIndex: null,
        };
    },
    mounted() {
        // this.getMembers();
        this.getCategories();
        // console.log(this.$moment);
        // this.getTasks();
    },
    computed: {
        reversedTasks() {
            return [...this.tasks].reverse().sort();
        },
        minDate() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = "0" + dd;
            }
            if (mm < 10) {
                mm = "0" + mm;
            }

            today = yyyy + "-" + mm + "-" + dd;
            return today;
        },
    },
    methods: {
        updateTaskStatus(n){
            let _this = this;
            _this.filteredTasks[_this.editIndex].pivot = n;
            _this.editIndex = null;
            _this.editEle = null;
        },
        assignMemeber(ele, index){
            this.editEle = ele;
            this.editIndex = index;
            this.showPopup = true;
        },
        changeTaskStatus(status, ele, index){
            let _this = this;
            _this.disableSubmit = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            let meth  = 'POST';
            let link = route('hosttasks.store')
            formData.append("type", status);
            formData.append("id", ele.pivot.id);
            axios({
                method: meth,
                url: link,
                data: formData,
            })
                .then((response) => {
                    // console.log(response);
                    _this.filteredTasks[index].pivot = response.data.data;
                    _this.disableSubmit = false;
                    _this.errorsSubmit = null;
                    _this.message = response.data["message"];
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    // console.log(error.response, error);
                    _this.errorsSubmit = error.response.data?.errors;
                    _this.disableSubmit = false;
                    if (error.response.data["message"]) {
                        _this.message = error.response.data["message"];
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    }
                });
            
            
        },
        timeDifference(startDate, endDate) {
            const start = this.$moment(startDate);
            const end = this.$moment(endDate);
            const duration = end.diff(start, 'days');
            return `${duration} days`;
        },
        filterTask(cat) {
            this.filteredTasks = this.taskList.filter(
                (obj) => obj.parent_id == cat.id
            );
        },
        saveTask() {
            this.tasks.push({
                id: this.tasks.length + 1,
                title: this.fields.title,
                taskPriority: this.fields.taskPriority,
                taskStatus: this.fields.taskStatus,
                dueDate: this.fields.dueDate,
                pinned: this.fields.pinned,
                member_id: this.fields.member_id,
                category_id: this.fields.category_id,
            });
            this.fields.title = "";
            this.fields.taskPriority = "low";
            this.fields.taskStatus = "";
            this.fields.dueDate = "";
            this.fields.member_id - "";
            this.fields.category_id = "";
            this.selectedMember = null;
        },
        doEdit(editing) {
            this.editing = editing;
            this.fields.title = "";
            this.fields.taskPriority = "low";
            this.fields.taskStatus = "";
            this.fields.startDate = "";
            this.fields.completionDate = "";
            this.fields.startTime = "";
            this.fields.completionTime = "";
            this.fields.invitation_id = this.invitation.id;
            (this.member_id = {}), (this.fields.category_id = "");
            this.editForm = false;
            this.taskId = null;
            this.selectedMember = null;
        },
        togglePinned(task) {
            task.pinned = !task.pinned;
        },

        addNewTask() {
            var _this = this;
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                const taskStatus = "Not Started";
                let type = "member";
                if (this.selectedMember?.role && this.selectedMember?.role.length > 0) {
                    type = "host";
                }
                this.fields = { ...this.fields, taskStatus };
                this.fields = { ...this.fields, type };
                console.log(this.fields);
                axios
                    .post("/submittask", this.fields)
                    .then((response) => {
                        _this.getTasks();
                        _this.loading = false;
                        _this.success = true;
                        _this.fields = {
                            invitation_id: this.invitation.id,
                            taskPriority: "low",
                        }; //Clear input fields.
                        _this.selectedMember = null;
                        _this.loaded = true;
                        _this.success = true;
                        _this.editing = false;
                    })
                    .catch((error) => {
                        _this.loaded = true;
                        if (error.response.status === 422) {
                            _this.errors = error.response.data.errors || {};
                        }
                    });
            }
        },
        // getMembers() {
        //     var _this = this;
        //     axios
        //         .get("/getmembers")
        //         .then(function (response) {
        //             _this.members = response.data;
        //         })
        //         .catch((error) => {
        //             console.log("Get All: " + error);
        //         });
        // },
        getCategories: function () {
            var _this = this;
            axios
                .get(route("admin.tasks.index"))
                .then((response) => {
                    _this.categories = response.data.data;
                    console.log(_this.categories);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getTasks() {
            var _this = this;
            axios
                .get("/gettasks")
                .then(function (response) {
                    _this.tasks = response.data;
                    console.log(_this.tasks);
                    _this.loading = false;
                })
                .catch((error) => {
                    console.log("Get All: " + error);
                });
        },
        setVal(task) {
            this.doEdit(true);
            this.taskId = task.id;
            this.fields.title = task.title;
            this.fields.category_id = task.category_id;
            this.fields.taskPriority = task.taskPriority;
            this.fields.assignable_id = task.assignable_id;
            this.fields.assignable_type = task.assignable_type;
            this.fields.startDate = new Date(task.startDate)
                .toISOString()
                .split("T")[0];
            this.fields.completionDate = new Date(task.completionDate)
                .toISOString()
                .split("T")[0];
            this.fields.startTime = task.startTime;
            this.fields.completionTime = task.completionTime;
            this.fields.taskStatus = task.taskStatus;
            this.editForm = true;
            //console.log(typeof this.taskDueDate);
        },
        updateTask() {
            var _this = this;
            var id = this.taskId;
            var title = this.fields.title;
            var category_id = this.fields.category_id;
            var taskPriority = this.fields.taskPriority;
            var startDate = this.fields.startDate;
            var completionDate = this.fields.completionDate;
            var startTime = this.fields.startTime;
            var completionTime = this.fields.completionTime;
            var taskStatus = this.fields.taskStatus;
            var assignable_id = this.fields.assignable_id;
            var assignable_type = this.fields.assignable_type;
            // let type = "member";
            //     if (this.selectedMember?.role && this.selectedMember?.role.length > 0) {
            //         type = "host";
            //     }
            //console.log(id,title,category_id,member_id,taskPriority,dueDate,taskStatus);
            //   axios({
            //     method: "post",
            //     url: "/updatetask/" + id,
            //     data: {
            //       title: title,
            //       category_id: category_id,
            //       member_id: member_id,
            //       taskPriority: taskPriority,
            //       dueDate: dueDate,
            //       taskStatus: taskStatus,
            //     },
            //   })
            //     .then(response => _this.getTasks())
            //     .catch(error => console.log(error));
            axios
                .patch(
                    "/updatetask/" + id,
                    {
                        title: title,
                        category_id: category_id,
                        member_id: member_id,
                        taskPriority: taskPriority,
                        startDate: startDate,
                        completionDate: completionDate,
                        startTime: startTime,
                        completionTime: completionTime,
                        taskStatus: taskStatus,
                        assignable_id: assignable_id,
                        assignable_type: assignable_type,
                    },
                    {
                        headers: {
                            "Content-Type": "application/json",
                            // Authorization: 'Bearer ' + varToken
                        },
                    }
                )
                .then((response) => {
                    _this.getTasks();
                    _this.loading = false;
                    _this.doEdit(false);
                    //console.log($("#myModal button:nth-child(1)"));
                    // $("#myModal button:nth-child(1)").attr(
                    //     "data-dismiss",
                    //     "modal"
                    // );
                    //$("#myModal button:nth-child(1)").click();
                    //console.log("ss");
                })
                .catch((error) => console.log(error));
        },
        deleteTask(task) {
            var _this = this;
            axios
                .post("/deletetask/" + task.id)
                .then(function (response) {
                    _this.getTasks();
                })
                .catch((error) => {
                    console.log("Delete task: " + error);
                });
        },
        closeForm() {
            this.showDropdown = false;
        },
    },
    created: function () {
        window.addEventListener("click", this.closeForm);
    },
    computed: {
        reversedTasks() {
            return [...this.tasks].reverse().sort();
        },
    },
};
</script>

<style scoped>
.counter {
    font-size: 0.8rem;
    padding-left: 10px;
    padding-right: 10px;
}

#task-list {
    padding: 1rem;
    border-radius: 3px;
    /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.12), 0 2px 4px 0 rgba(0, 0, 0, 0.08); */
    width: 95%;
    max-width: 100%;
}

h1 {
    color: #3d4852;
}

ul {
    list-style: none;
    padding: 0;
}

a {
    color: #6cb2eb;
    font-size: 1.25rem;
    transition: all 0.1s ease-in;
    margin-top: 0.5rem;
    display: block;
}

a:hover {
    color: #3490dc;
}

li,
p {
    display: flex;
    align-items: center;
    letter-spacing: 0.5px;
    color: #3d4852;
    cursor: pointer;
    transition: all 0.1s ease-in;
}

li:hover {
    color: #22292f;
}

li input {
    margin: 0 0.5rem 0;
}

#task-list > input,
#task-list > select {
    width: 100%;
    border-radius: 3px;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid #f1f5f8;
    color: #606f7b;
    padding: 0.5rem 0.75rem;
    box-sizing: border-box;
    font-size: 1rem;
    letter-spacing: 0.5px;
    margin: 0.5rem 0;
}

.btn {
    border: none;
    border-radius: 3px;
    margin: auto 0;
    padding: 0.5rem 0.75rem;
    flex-shrink: 0;
    cursor: pointer;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    transition: all 0.1s ease-in;
}

.btn[disabled] {
    background: #8795a1;
}

.btn[disabled]:hover {
    background: #606f7b;
}

.btn-primary {
    background: #6cb2eb;
    color: #fff;
}

.btn-primary:hover {
    background: #3490dc;
}

.btn-cancel {
    background: #ef5753;
    color: #000;
}

.btn-cancel:hover {
    background: #e3342f;
    color: rgba(255, 255, 255);
}

.strikeout {
    text-decoration: line-through;
    color: white;
    background-color: lightblue;
}

.notstarted {
    background-color: red;
    color: white;
    border-radius: 2em;
    padding: 0.3em 0.5em;
}

tr {
    margin: 0.3em 0;
}

.inprogress {
    background-color: yellow;
    color: white;
}

.completed {
    background-color: green;
    color: white;
}

.strikeout:hover {
    color: #8795a1;
}

.priority {
    color: #de751f;
}

input:hover,
select:hover {
    background-color: pink;
    cursor: pointer;
}

input[type="checkbox"] {
    display: inline !important;
    box-shadow: none;
}

td:hover {
    cursor: pointer;
}
.task-title {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    text-align: center;
    position: relative;
    color: #333333;
}
.task-title > button {
    background: #c4456f;
    border-radius: 5px;
    padding: 11px 18px 12px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 16px;
    color: #ffffff;
    position: absolute;
    right: 0;
    outline: none;
    border: none;
    display: flex;
    align-items: center;
    top: 20px;
}
.task-title > button > span {
    font-size: 17px;
    margin-right: 5px;
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
.form-label-radio > input {
    margin-right: 5px;
}
.date-grp {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.date-grp > div {
    width: 48%;
}
.date-grp > div > input {
    width: 100%;
}
.task-list-single {
    background: #ffffff;
    border: 0.5px solid #d2d2d2;
    border-radius: 5px;
    padding: 22px;
    margin-bottom: 10px;
}
.single-first-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}
.single-first-row > div:nth-child(1) {
    display: flex;
    flex-wrap: wrap;
}
.single-first-row > div:nth-child(2) {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}
.single-first-row > div:nth-child(1) > span:nth-child(1) {
    background: #f31c45;
    border-radius: 10px;
    padding: 5px 8px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.74194px;
    line-height: 12px;
    color: #ffffff;
    margin-right: 10px;
    margin-bottom: 5px;
    display: inline-block;
    text-align: center;
}
.single-first-row > div:nth-child(1) > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 14px;
    line-height: 18px;
    color: #000000;
}
.single-first-row > div:nth-child(2) > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.60469px;
    line-height: 13px;
    margin-right: 10px;
    color: #2fa706;
}
.single-first-row > div:nth-child(2) > span:nth-child(2) {
    display: flex;
}
.single-first-row > div:nth-child(2) > span:nth-child(1) > img {
    width: 17px;
    height: 12px;
}
.single-first-row > div:nth-child(2) > span:nth-child(2) > img {
    width: 37px;
    height: 32px;
    margin-right: 5px;
    cursor: pointer;
}
.single-second-row {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #000000;
    margin-bottom: 17px;
}
.single-third-row {
    display: flex;
    align-items: center;
}
.single-third-row > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 10.60469px;
    line-height: 13px;
    color: #000000;
    margin-right: 15px;
    display: flex;
    align-items: center;
}
.single-third-row > div > img {
    margin-right: 5px;
}
.single-third-row > div:nth-child(3) > span {
    width: 7px;
    height: 7px;
    display: inline-block;
    border-radius: 50%;
    background-color: #2fa706;
    margin-right: 5px;
}
.single-third-row > div:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.99808px;
    line-height: 12px;
    /* identical to box height */

    color: #2fa706;
}
.custom-select-box {
    min-height: 37px;
    position: relative;
}
.custom-select-box > span {
    background-image: url(/assets/icon-down.svg);
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
    background-color: rgba(239, 220, 226, 0.2);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    cursor: pointer;
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    height: 37px;
}
.custom-select-box > span:hover {
    background-color: pink !important;
}
.custom-select-box > div > span {
    background-color: rgba(239, 220, 226, 0.2);
}
.custom-select-box > div {
    background-color: pink;
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
    cursor: pointer;
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    position: absolute;
    top: 36px;
    left: 0;
}
.custom-select-box > div > span {
    display: block;
    width: 100%;
    padding: 5px;
}
@media only screen and (max-width: 768px) {
    .single-third-row {
        flex-wrap: wrap;
    }
    .single-third-row > div:nth-child(3) {
        width: 100%;
        margin-top: 7px;
    }
    .task-title > button {
        position: unset;
        display: block;
        margin: 5px auto;
    }
}
@media only screen and (max-width: 996px) {
    .form-row {
        width: 100%;
    }
}
</style>
