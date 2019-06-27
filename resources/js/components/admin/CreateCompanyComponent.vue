<template>
<div class="container">
  <div>
    <h1>Create A Company</h1>
    
    <form @submit.prevent="addCompany">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Name:</label>
            <input type="text" class="form-control" v-model="company.name">
          </div>
        </div>
        </div>
         <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Email:</label>
            <input type="text" class="form-control" v-model="company.email">
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Company Description:</label>
              <textarea class="form-control" v-model="company.description" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Url:</label>
            <input type="text" class="form-control" v-model="company.url">
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
         <strong>Company Logo:</strong>
         <input type="text" class="form-control" v-model="company.logo">
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
          company:{},
          errors:{},
        }
    },
    methods: {

    addCompany(){
            //console.log(this.company);this.errors = {};
      axios.post('/api/companies/create', this.company).then(response => {
        alert('Message sent!');
      }).catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        }
      });
            
    }

    }
  }
</script>
