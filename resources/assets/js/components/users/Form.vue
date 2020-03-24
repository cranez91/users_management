<template>
	<div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">                      
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">                    
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" v-model="user.name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" v-model="user.last_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="text" v-model="user.age" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" v-model="user.phone" class="form-control" required>
                                </div>  
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="text" v-model="user.photo" class="form-control" required>
                                </div> 
                                <div class="form-group">
                                    <label>Admission Date</label>
                                    <input type="text" v-model="user.admission_date" class="form-control" required>
                                </div>                 
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="button" @click="send()" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</template>

<script>
	export default {
	    data(){
	        return {
	        	user: {
	        		name: "",
	        		last_name: "",
	        		age: "",
	        		phone: "",
	        		photo: "",
	        		admission_date: ""
	        	}
	        }
	    },
		methods:{
			send(){
				
				if(!this.validate()){
					return;
				}

				var url_to = "/api/users";
				var data = this.setData();

				axios({
					method: "POST",
					url: url_to,
					data: data,
					headers: {
						"Accept": "application/json",
						"Content-Type": "application/json"
					}
				}).then((response)=>{
					if( response.data.status == "error" ){
						alert("error");
					} else if ( response.data.status == "ok" ){
		                alert("Guardado");
					}
				}).catch ((error) => {
					alert("Ocurrió un error inesperado");
		        });  
			},
			validate(){
				if( !this.user.name || !this.user.last_name || !this.user.age || !this.user.phone || !this.user.photo || !this.user.admission_date ){
					alert("todos los campos son obligatorios");
					return false;
				}
				return true;
			},
			setData(){
				let data = {
					name: this.user.name || null,
					last_name: this.user.last_name || null,
					age: this.user.age || null,
					phone: this.user.phone || null,
					photo: this.user.photo || null,
					admission_date: this.user.admission_date || null,
				};

				return  data;
			},
	          makeSwal(swalTitle, swalText, swalType, buttonText){
		        swal({
		          title: swalTitle,
		          html: swalText,
		          type: swalType,
		          confirmButtonText: buttonText,
		          allowOutsideClick: false
		        });
		      }
		}
    }
</script>