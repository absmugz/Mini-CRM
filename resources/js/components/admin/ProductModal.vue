 <template>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header" v-html="data.name"></slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            Name: <input type="text" v-model="data.name">
                            Email: <input type="text" v-model="data.email">
                            <textarea v-model="data.description" placeholder="description"></textarea>
                             Url: <input type="text" v-model="data.Url">
                            <span >
                                <img :src="data.logo" v-show="data.logo != null">
                                <input type="file" id="file" @change="attachFile">
                            </span>
                        </slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button" @click="uploadFile">
                                Finish
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    </style>

    <script>
    export default {
        props: ['company'],
        data() {
            return {
                attachment: null
            }
        },
        computed: {
            data: function() {
                if (this.company != null) {
                    return this.company
                }
                return {
                    name: "",
                    email: "",
                    url: "",
                    description: "",
                    logo: false
                }
            }
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                if (this.attachment != null) {
                    var formData = new FormData();
                    formData.append("logo", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.company.logo = response.data
                        this.$emit('close', this.company)
                    })
                } else {
                    this.$emit('close', this.company)
                }
            }
        }
    }
    </script>