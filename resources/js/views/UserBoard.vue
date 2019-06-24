<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">User Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        
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
    export default {
        data() {
            return {
                user : null
            }
        },
        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('Mini-CRM.user'))

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('Mini-CRM.jwt')

        }
    }
    </script>