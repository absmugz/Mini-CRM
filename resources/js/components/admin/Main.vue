    <template>
        <div class="row">
            <div class="col-md-6 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
                <a href='/admin/companies'>Companies ({{companies.length}})</a>
            </div>
            <div class="col-md-6 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
                <a href='/admin/users'>Users ({{users.length}})</a>
            </div>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                user : null,
                companies : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/companies/').then(response => this.companies = response.data)
        }
    }
    </script>

    <style scoped>
    .big-text { font-size: 28px; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; height: 20vh }
    </style>