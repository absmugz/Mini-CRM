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
        <modal @close="endEditing" :company="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addCompany"  :company="addingCompany" v-show="addingCompany != null"></modal>
        <br>
            <button class="btn btn-primary" @click="newProduct">Add New Company</button>
        </div>
    </template>
<script>
    import Modal from './ProductModal'
	export default {
        data(){
            return {
                companies : [],
                editingItem : null,
                addingCompany : null
            }
        },
        components : {
            Modal
        },
        beforeMount(){
            axios.get('/api/companies/')
            .then(response => {
                this.companies = response.data
            })
            .catch(error => {
                console.error(error);
            })     
        },
        methods : {
            newProduct(){
                this.addingCompany = {
                    name : null, 
                    email : null, 
                    url : null,
                    description : null,
                    logo : null
                }
            },
            editingItem(company){
                this.editingItem = null
                let index = this.companies.indexOf(company)
                axios.put(`/api/companies/${company.id}`,{
                    name  : product.name,
                    email : product.email,
                    url : product.url,
                    description : product.description,
                })
                .then(response =>{
                    this.companies[index] = company
                })
                .catch(response => {
                })
            },
            addCompany(company){
                this.addingCompany = null
                axios.post("/api/companies/",{
                    name  : company.name,
                    email : company.email,
                    url : company.price,
                    description : company.description,
                    logo : product.logo
                })
                .then(response =>{
                    this.companies.push(company)
                })
                .catch(response => {
                })
            }
        }
    }
</script>
    