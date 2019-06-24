    <template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <img :src="company.logo" :alt="company.name">
                    <h3 class="title" v-html="company.name"></h3>
                    <p class="text-muted">{{company.description}}</p>
                    <h4>
                        <span class="small-text text-muted float-left">{{company.email}}</span>
                    </h4> 
                    <br>
                    <hr>
                    <router-link :to="{ path: company.url }" class="col-md-4 btn btn-sm btn-primary float-right">Visit Website</router-link>
                </div>
            </div>
        </div>
    </template>

    <script>
    export default {
        data(){
            return {
                company : []
            }
        },
        beforeMount(){
            let url = `/api/companies/${this.$route.params.id}`
            axios.get(url).then(response => this.company = response.data)      
        }
    }
    </script>

    <style scoped>
    .small-text { font-size: 18px; }
    .title { font-size: 36px; }
    </style>