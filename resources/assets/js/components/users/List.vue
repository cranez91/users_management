<template>
    <div>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Users</b></h2>
                        </div>
                        <div class="col-sm-6">
                            
                            <a href="#addModal" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> 
                                <span>New User</span>
                            </a>
                            <a href="#importModal" class="btn btn-primary" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> 
                                <span>Import from file</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>Admission Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in lstUsers" :key="user.id">
                                <td>
                                    <a href="#">
                                        <img :src="'/images/'+user.photo" class="avatar" alt="Avatar">
                                    </a>
                                </td>
                                <td>
                                    {{user.name}}
                                </td>
                                <td>{{user.last_name}}</td>
                                <td>{{user.age}}</td>
                                <td>{{user.phone}}</td>
                                <td>{{user.admission_date}}</td>
                                <td>
                                    <a href="#editModal" @click="editUser(user)" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#" class="delete" @click="deleteUser(index)"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="addModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">                      
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" v-model="user.name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" v-model="user.last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="text" v-model="user.age" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" v-model="user.phone" class="form-control" required>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="photo">Photo</label>
                                  <input type="file" @change="fileChanged($event)" id="photo" ref="fileInput">
                                  <p class="help-block">Example block-level help text here.</p>
                                </div>  
                            </div>                   
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Admission Date</label>
                                    <input type="date" v-model="user.admission_date" class="form-control" required>
                                </div>    
                            </div>                                 
                        </div>
                        <div class="modal-footer">
                            <input type="button" @click="reset()" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" @click="send()" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="importModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">                      
                            <h4 class="modal-title">Import Users</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="file">File</label>
                                  <input type="file" @change="fileChanged($event)" id="file" ref="fileInput">
                                </div>  
                            </div>                   
                        </div>
                        <div class="modal-footer">
                            <input type="button" @click="reset()" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" @click="importFile()" class="btn btn-success" value="Import">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">                      
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" v-model="edit_user.name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" v-model="edit_user.last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="text" v-model="edit_user.age" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" v-model="edit_user.phone" class="form-control" required>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="photoEdit">Photo</label>
                                  <input type="file" @change="fileChanged($event)" id="photoEdit" ref="fileInput">
                                  <p class="help-block">Example block-level help text here.</p>
                                </div>  
                            </div>                   
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Admission Date</label>
                                    <input type="date" v-model="edit_user.admission_date" class="form-control" required>
                                </div>    
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <input type="button" @click="reset()" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" @click="updateUser()" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
</template>

<script>
  import swal from 'sweetalert2'
  export default {
    components: {
      swal
    },
    created(){
      this.getUsers()
    },
    data () {
      return {
        my_file: null,
        file_type: "",
        edit_user: {
            name: "",
            last_name: "",
            age: "",
            phone: "",
            photo: "",
            admission_date: ""
        },
        user: {
            name: "",
            last_name: "",
            age: "",
            phone: "",
            photo: "",
            admission_date: ""
        },
        lstUsers: []
      }
    },
    methods: {
        fileChanged(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },

        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;
            var str = file.name;
            this.user.photo = str.replace(" ", "_");
            this.file_type = file.type;
            reader.onload = (e) => {
                vm.my_file = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        editUser (user) {
            this.edit_user = JSON.parse(JSON.stringify(user));
            this.edit_user.admission_date = this.edit_user.admission_date.substring(0, 10);
        },
        update(id) {
            var body = { my_file: this.my_file};
            axios({
                method: 'put',
                url: '/api/upload/file/'+id,
                data: body,
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
                })
            .then(function (response) {
            })
            .catch(function (response) {
            });
        },
        importFile() {
            if( this.file_type && this.file_type !== "application/vnd.ms-excel" ){
                this.makeSwal("Wait!", "Only csv files are allowed.", "warning", "Ok");
                return false;
            }
            var body = { file: this.my_file};
            axios({
                method: 'put',
                url: '/api/import/file',
                data: body,
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
                })
            .then((response)=>{
                this.reset();
                this.getUsers();
                $("#importModal").modal('hide');
                $('.modal-backdrop').remove();
                this.makeSwal("Done!", "The users has been imported from file.", "success", "Ok");
            })
            .catch ((error) => {
                this.makeSwal("Error", "Something went wrong, please try again.", "error", "Ok");
            });
        },
        updateUser() {
            if(!this.validateImageType()){
                return;
            }
            axios({
                method: 'PATCH',
                url: '/api/users/'+this.edit_user.id,
                data: this.setData(this.edit_user),
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
                })
            .then((response)=>{
                if (this.my_file) {
                    this.update(this.edit_user.id);
                }
                this.reset();
                this.getUsers();
                $("#editModal").modal('hide');
                $('.modal-backdrop').remove();
                this.makeSwal("Updated!", "The user has been updated.", "success", "Ok");
            })
            .catch ((error) => {
                var msg = "";
                for (var data in error.response.data.errors) {
                    msg += "-" + error.response.data.errors[data] + "<br>";
                }
                this.makeSwal("Sorry", msg, "error", "Ok");
            });
        },
        getUsers () {
          axios.get('/api/users')
            .then(response => {
              this.lstUsers = response.data;
            })
        },
        deleteUser (index) {
          let toDelete = this.lstUsers[index];
          swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
          }).then(function () {
            axios.delete('/api/users/' + toDelete.id)
              .then(response => {
                this.lstUsers.splice(index, 1);
                this.makeSwal("Deleted!", "The user has been deleted.", "success", "Done");
              })
          }.bind(this))
        },
        send(){
            if(!this.validate()){
                return;
            }
            if(!this.validateImageType()){
                return;
            }
            axios({
                method: "POST",
                url: "/api/users",
                data: this.setData(this.user),
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
            }).then((response)=>{
                this.user.id = response.data.id;
                this.update(this.user.id);
                this.reset();
                this.getUsers();
                $("#addModal").modal('hide');
                $('.modal-backdrop').remove();
                this.makeSwal("Created!", "The user has been created.", "success", "Ok");
            }).catch ((error) => {
                var msg = "";
                for (var data in error.response.data.errors) {
                    msg += "-" + error.response.data.errors[data] + "<br>";
                }
                this.makeSwal("Sorry", msg, "error", "Ok");
            });  
        },
        validate(){
            if( !this.user.name || !this.user.last_name || !this.user.age || !this.user.phone || !this.my_file || !this.user.admission_date ){
                this.makeSwal("Wait!", "All the fields are required.", "warning", "Ok");
                return false;
            }
            return true;
        },
        validateImageType(){
            if(this.file_type && (this.file_type !== "image/jpeg" && this.file_type !== "image/png") ){
                this.makeSwal("Wait!", "Only jpg/png files are allowed.", "warning", "Ok");
                return false;
            }
            return true;
        },
        setData(user){
            let data = {
                name: user.name || null,
                last_name: user.last_name || null,
                age: user.age || null,
                phone: user.phone || null,
                photo: user.photo || null,
                admission_date: user.admission_date + " 00:00:00" || null,
            };
            return  data;
        },
        reset(){
            this.my_file = null;
            this.file_type = "";
            this.edit_user = {
                name: "",
                last_name: "",
                age: "",
                phone: "",
                photo: "",
                admission_date: ""
            };
            this.user = {
                name: "",
                last_name: "",
                age: "",
                phone: "",
                photo: "",
                admission_date: ""
            };
        },
        makeSwal(swalTitle, swalText, swalType, buttonText){
          swal({
            title: swalTitle,
            html: swalText,
            type: swalType,
            confirmButtonText: buttonText
          });
        }
    }
  }
</script>
