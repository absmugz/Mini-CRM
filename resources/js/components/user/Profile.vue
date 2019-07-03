<template>
  <div>
      <h1>My Profile</h1>
        <br />

        <table class="table table-hover">
            <thead>
            <tr>
               
                <th>Name</th>
                <th>Email</th>
            
               
            </tr>
            </thead>
            <tbody>
                <tr>
               
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                   
                  
                </tr>
            </tbody>
        </table>
  </div>
</template>
    

    <script>

    export default {
        data() {
            return {
                user : null,
               
            }
        },
        beforeMount() {
            
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            console.log(this.user)
            //console.log(localStorage.getItem('jwt'))

        },
        methods: {

        }
    }
    </script>