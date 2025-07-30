<template>
    <div class="member">
        <div class="row">
            <div class="col-sm-4">
                  <div class="title m-b-md">
                        Member
                    </div>
                <form class="wed-member-form" id="wed-member-form">
                    <div class="alert alert-danger" role="alert" v-if="hasError">
                        All fields are required!
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required placeholder="Name" name="name" v-model="newMember.name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required placeholder="Email" name="email" v-model="newMember.email">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="mobile" required placeholder="Mobile" name="mobile" v-model="newMember.mobile">
                    </div>
                    <div class="form-group">
                        <label for="department" class="form-label">
                            Department
                        </label>
                         <select v-model="newMember.department" name="department" id="department"  class="form-control">
                            <option value="catering">Catering</option>
                            <option value="photography">Photography</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <button type="submit" class="btn wed-btn-main btn-sm" @click.prevent="createMember()">
                    <span class="material-icons">save</span>
                    </button>
                </form>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Department</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for ="member in reversedMembers" :key="member.id">
                            <th scope="row">{{member.name}}</th>
                            <td>{{member.email}}</td>
                            <td>{{member.mobile}}</td>
                            <td>{{member.department}}</td>
                            <td @click="setVal(member.id, member.name, member.email, member.mobile,member.department)" data-toggle="modal" data-target="#myModal"><span class="material-icons">edit</span>
                            </td>
                            <td  @click="deleteMember(member)" class="text-danger">
                                <span class="material-icons">delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                                required  :value="this.e_id">
                        Name: <input type="text" class="form-control" id="e_name" name="name"
                                                required  :value="this.e_name">
                        Email: <input type="text" class="form-control" id="e_email" name="email"
                                        required  :value="this.e_email">
                        Mobile: <input type="text" class="form-control" id="e_mobile" name="mobile"
                                        required  :value="this.e_mobile">
                        Department: <input type="text" class="form-control" id="e_department" name="department" required  :value="this.e_department">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="updateMember()"><span class="material-icons">save</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

  <script>
        export default {
        props: ['hostId'],
        data() {
            return {
                newMember: {'name': '', 'email': '', 'mobile' : '', 'host_id' : this.hostId, 'department' : '', 'slug' : '' },
                hasError: false,
                members: [],
                e_id: '',
                e_name: '',
                e_email: '',
                e_mobile: '',
                e_department: ''
            }
        },
        mounted() {
            this.getMembers();
        },
        methods: {
            createMember() {
                var input = this.newMember;
                const slug =  input.name.toLowerCase()+'-'+Math.floor((Math.random()* 100)+1);
                var input = {...input, slug}
                var _this = this;
                if(input['name'] == '' || input['email'] == ''  || input['mobile'] == '' || input['department' == '']) {
                    this.hasError = true;
                }
                else {
                    axios.post('/storemember', input)
                    .then(function(response){
                        _this.newMember = {'name': '', 'email': '', 'mobile' :'', 'department': '', 'host_id': _this.hostId, 'slug': input.name};
                        _this.hasError = false;
                        _this.getMembers();
                    }).catch(error=>{
                        console.log("Insert: "+error);
                    });
                }
            },
            getMembers(){
                var _this = this;
                axios.get('/getmembers').then(function(response){
                    _this.members = response.data;
                }).catch(error=>{
                    console.log("Get All: "+error);
                });
            },
            deleteMember(member) {
                    var _this = this;
                    axios.post('/deletemembers/' + member.id).then(function(response){
                        _this.getMembers();
                    }).catch(error=>{
                        console.log("Delete member: "+error);
                    });
            },
            setVal(val_id, val_name, val_email,val_mobile, val_department) {
                this.e_id = val_id;
                this.e_name = val_name
                this.e_email = val_email,
                this.e_mobile = val_mobile,
                this.e_department = val_department
            },
            updateMember(){
                var _this = this;
                var id_val_1 = document.getElementById('e_id');
                var name_val_1 = document.getElementById('e_name');
                var email_val_1 = document.getElementById('e_email');
                var mobile_val_1 = document.getElementById('e_mobile');
                var model = document.getElementById('myModal').value;
                axios.post('/updatemembers/' + id_val_1.value, {val_1: name_val_1.value, val_2: email_val_1.value, val_3: mobile_val_1.value})
                .then(response => {
                    _this.getMembers();
                });
            },
        },
         computed:{
            reversedMembers(){
            return [...this.members].reverse().sort()
            }
         },
    }
</script>

<style scoped>

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

.title {
    font-size: 2em;
}
.m-b-md {
    margin-bottom: 1em;
}

</style>
