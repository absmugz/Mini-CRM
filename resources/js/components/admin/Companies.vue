<template>
  <div>
      <h1>Companies</h1>
        <div class="row">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <router-link :to="{ name: 'create-company' }" class="btn btn-primary">Create Company</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="company in companies" :key="company.id">
                    <td>{{ company.id }}</td>
                    <td>{{ company.name }}</td>
                    <td>{{ company.description }}</td>
                    <td><router-link :to="{name: 'edit-company', params: { id: company.id }}" class="btn btn-primary">Edit</router-link></td>
                      <td><button class="btn btn-danger" @click.prevent="deleteCompany(company.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
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
        },
         methods: {
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