    <template>
        <div>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <td></td>
                        <td>Product</td>
                        <td>Email</td>
                        <td>Description</td>
                        <td>logo</td>
                        <td>Url</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(company,index) in companies" :key="index" @dblclick="editingItem = company">
                        <td>{{index+1}}</td>
                        <td v-html="company.name"></td>
                        <td v-model="company.email">{{company.email}}</td>
                        <td v-model="company.description">{{company.description}}</td>
                        <td v-model="company.logo">{{company.logo}}</td>
                        <td v-model="company.url">{{company.url}}</td>
                    </tr>
                </tbody>
            </table>
            <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
            <modal @close="addCompany"  :product="addingCompany" v-show="addingCompany != null"></modal>
            <br>
            <button class="btn btn-primary" @click="newProduct">Add New Company</button>
        </div>
    </template>

    <script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                companies: [],
                editingItem: null,
                addingCompany: null
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/companies/').then(response => this.companies = response.data)
        },
        methods: {
            newProduct() {
                this.addingCompany = {

                    name: null,
                    email: null,
                    description: null,
                    logo: null,
                    url: null,
                }
            },
            endEditing(company) {
                this.editingItem = null

                let index = this.companies.indexOf(company)
                let name = company.name
                let email = company.email
                let description = company.description
                let url = company.url

                axios.put(`/api/companies/${company.id}`, {name, email, description, url})
                     .then(response => this.companies[index] = company)
            },
            addCompany(company) {
                this.addingCompany = null

                let name = company.name
                let email = company.email
                let description = company.description
                let url = company.url
                let logo = company.logo 

                axios.post("/api/companies/", {name, email, description, url, logo})
                     .then(response => this.companies.push(company))
            }
        }
    }
    </script>