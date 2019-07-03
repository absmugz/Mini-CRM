<template>
<div class="container">
  <div>
    <h1>Edit Profile</h1>
    <div v-if="success" class="alert alert-success mt-3">
                Profile edited!
    </div>
    <form @submit.prevent="updateUser">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Employee Name:</label>
            <input type="text" class="form-control" v-model="user.name">
            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
          </div>
        </div>
        </div>
         <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Employee Email:</label>
            <input type="text" class="form-control" v-model="user.email">
             <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Employee Password:</label>
            <input type="password" class="form-control" v-model="user.password">
             <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
          </div>
        </div>
         <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" class="form-control" v-model="user.c_password">
             <div v-if="errors && errors.c_password" class="text-danger">{{ errors.c_password[0] }}</div>
          </div>
        </div>

             <div class="col-md-12">
          <div class="form-group">
           
           <label for="sel1">Select Company:</label>
  <select class="form-control" v-model="user.company_id">
    <option v-for="company in companies" :key="company.id" :value="company.id">{{ company.name }}</option>
  </select>
 
          </div>
         
        </div>
 
      
        </div>
       
       
       
        <br />
        <div class="form-group">
          <button class="btn btn-primary">Update Profile</button>
        </div>
    </form>
    </div>
  </div>
</template>


<script>
  export default {
      data() {
        return {
          user:null,
          errors:{},
          success: false,
          loaded: true,
          companies: []
        }
      },beforeMount(){
            axios.get('/api/companies/')
            .then(response => {
                this.companies = response.data
            })
            .catch(error => {
                console.error(error);
            })  
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            //console.log(this.user)
            //console.log(localStorage.getItem('jwt'))   
        },
         methods: {
    updateUser() {
     //console.log(this.user);
     if (this.loaded, this.user) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        let uri = `/api/users/update/${this.user.id}`
        axios.post(uri, this.user).then(response => {
          this.user = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
          //this.$router.push({name: 'admin'});
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
      
    },
      deleteCompany(id)
      {
      //console.log(id)
      
      let url = `/api/companies/delete/${id}`
      console.log(url)
         axios.post(url).then(
          response => {
          this.companies.splice(this.companies.indexOf(id), 1);
        }
        )
      }
    }
  }
</script>