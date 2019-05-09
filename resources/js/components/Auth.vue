<template>
    <div class="card mt-5">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <login />
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <register />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            send(){
                axios.post('/register', this.form).then((response)=>{
                    if(response.data.id){
                        window.location.href = '/'
                    }
                }).catch((errors)=>{
                    this.errors = errors.response.data.errors
                })
            },
            cleanErrors(){
                this.errors = {}
            }
        }
    }
</script>

<style scoped>

</style>
