<template>
<div class="container">
  <div>
    <h1>Create A Company</h1>
    <div v-if="success" class="alert alert-success mt-3">
                Company created!
    </div>
    <form @submit.prevent="addCompany">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Name:</label>
            <input type="text" class="form-control" v-model="name">
            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
          </div>
        </div>
        </div>
         <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Email:</label>
            <input type="text" class="form-control" v-model="email">
             <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Company Description:</label>
              <textarea class="form-control" v-model="description" rows="5"></textarea>
              <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Url:</label>
            <input type="text" class="form-control" v-model="url">
             <div v-if="errors && errors.url" class="text-danger">{{ errors.url[0] }}</div>
          </div>
        </div>
        </div>
         <div class="row">
        <div class="col-md-12">
          <div class="form-group">
         <strong>Company Logo:</strong>
         <input type="file" class="form-control" @change="onFileSelected">
        </div>
        </div>
        </div>
        <br />
        <div class="form-group">
          <button class="btn btn-primary">Create Company</button>
        </div>
    </form>
    </div>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          //company:{},
          name:'',
          email:'',
          description:'',
          url:'',
          logo:'',
          errors:{},
          success: false,
          loaded: true,
          selectedFile:null
        }
    },
      methods: {
      onFileSelected(event) {
      console.log(event)
      this.logo = event.target.files[0]
      console.log(this.logo)
    },
    addCompany(event) {


      if (this.loaded) {
        const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
        let formData = new FormData();
        formData.append('logo', this.logo);
        formData.append('name', this.name);
        formData.append('email', this.email);
        formData.append('description', this.description);
        formData.append('url', this.url);
        formData.append('logo', this.logo);
        this.loaded = false;
        this.success = false;
        this.errors = {};
        
        axios.post('/api/companies/create', formData, config ).then(response => {
          //this.company = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    }

  }
  }
</script>
