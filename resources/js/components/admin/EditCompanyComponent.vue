<template>
<div class="container">
  <div>
    <h1>Edit A Company</h1>
    <div v-if="success" class="alert alert-success mt-3">
                Company edited!
    </div>
    <form @submit.prevent="updateCompany">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Name:</label>
            <input type="text" class="form-control" v-model="company.name">
            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
          </div>
        </div>
        </div>
         <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Email:</label>
            <input type="text" class="form-control" v-model="company.email">
             <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Company Description:</label>
              <textarea class="form-control" v-model="company.description" rows="5"></textarea>
              <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Company Url:</label>
            <input type="text" class="form-control" v-model="company.url">
             <div v-if="errors && errors.url" class="text-danger">{{ errors.url[0] }}</div>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
         <strong>Company Logo:</strong>
         <input type="text" class="form-control" v-model="company.logo">
         <div v-if="errors && errors.logo" class="text-danger">{{ errors.logo[0] }}</div>
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
          success: false,
          loaded: true,
        }
    },
      created() {
         let url = `/api/companies/edit/${this.$route.params.id}`
        axios.get(url).then(response => this.company = response.data)
      },
      methods: {
        updateCompany() {
          let uri = `http://vuelaravelcrud.test/api/post/update/${this.$route.params.id}`;
          this.axios.post(uri, this.post).then((response) => {
            this.$router.push({name: 'posts'});
          });
        }
      }
    }
</script>