<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Admin Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul style="list-style-type:none">
                            <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                            <li><button class="btn" @click="setComponent('companies')">Companies</button></li>
                            <li><button class="btn" @click="setComponent('users')">Users</button></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Companies from '../components/admin/Companies'
    import CreateCompanyComponent from '../components/admin/CreateCompanyComponent'
    import EditCompanyComponent from '../components/admin/EditCompanyComponent'
    

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
        Main, Users, Companies, CreateCompanyComponent, EditCompanyComponent

        },
       beforeMount(){
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "companies":
                        this.activeComponent = Companies
                        this.$router.push({name: 'admin-pages', params: {page: 'companies'}})
                        break;
                    case "create-companies":
                        this.activeComponent = CreateCompanyComponent
                        this.$router.push({name: 'admin-pages', params: {page: 'create-companies'}})
                        break;
                    case "edit-companies":
                        this.activeComponent = EditCompanyComponent
                        this.$router.push({name: 'admin-pages', params: {page: 'edit-companies'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
    </script>

    <style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>