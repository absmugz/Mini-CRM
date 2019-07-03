<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">User Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul style="list-style-type:none">
                            <li class="active"><button class="btn" @click="setComponent('profile')">Profile</button></li>
                             <li><button class="btn" @click="setComponent('edit-profile')">Edit Profile</button></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    .small-text { font-size: 14px; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; }
    .hero-section { background: #ababab; height: 20vh; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>

    <script>

    import Profile from '../components/user/Profile'
    import EditProfileComponent from '../components/user/EditProfileComponent'

    export default {
        data() {
            return {
                user : null,
                 activeComponent: null
            }
        },
        components: {
        Profile, EditProfileComponent

        },
        beforeMount() {
            
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
            //console.log(this.user)
            //console.log(localStorage.getItem('jwt'))

        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "edit-profile":
                        this.activeComponent = EditProfileComponent
                         this.$router.push({name: 'dashboard-pages', params: {page: 'edit-profile'}})
                        break;
                    default:
                        this.activeComponent = Profile
                         this.$router.push({name: 'dashboard-pages', params: {page: 'profile'}})
                        break;
                }
            }
        }
    }
    </script>