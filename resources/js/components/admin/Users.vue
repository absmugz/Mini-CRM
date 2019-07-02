<template>
    <div>
      <h1>Users</h1>
        <div class="row">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <router-link :to="{ name: 'create-company' }" class="btn btn-primary">Create User</router-link>
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
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                     <td><button class="btn btn-primary">Edit</button></td>
                      <td><button class="btn btn-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>
<script>
	export default {
        data(){
            return {
                users : []
            }
        },
        beforeMount(){
            axios.get('/api/users/')
            .then(response => {
                this.users = response.data
                console.log(this.users)
            })
            .catch(error => {
                console.error(error);
            })     
        }
    }
</script>