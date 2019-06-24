<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Welcome to the Mini CMS</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 product-box" v-for="(company,index) in companies" :key="index">
                                <router-link :to="{ path: '/companies/'+company.id}">
                                    <img :src="company.logo" :alt="company.name" class="company img-responsive" >
                                    <h5><span v-html="company.name"></span>
                                        <span class="small-text text-muted float-right">$ {{company.email}}</span>
                                    </h5>
                                    <button class="col-md-4 btn btn-sm btn-primary float-right">View Profile</button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
        export default {
            data(){
                return {
                    companies : []
                }
            },
            mounted(){
                axios.get("api/companies/").then(response => this.companies = response.data)      
            }
        }
    </script>

     <style scoped>
    .small-text {
        font-size: 14px;
    }

    .company {
    width:100%;
    height: 230px;
}
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    </style>