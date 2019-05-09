<template>
    <form method="post" action="#" @submit.prevent="send">
        <div class="form-group mt-3">
            <label for="firstname">Firstname</label>
            <input @keyup="cleanErrors" type="text" id="firstname" name="firstname" class="form-control" v-model="form.firstname" />
            <span v-if="this.errors.firstname" class="text-danger">{{ this.errors.firstname[0] }}</span>
        </div>
        <div class="form-group mt-3">
            <label for="lastname">lastname</label>
            <input @keyup="cleanErrors" type="text" id="lastname" name="lastname" class="form-control" v-model="form.lastname" />
            <span v-if="this.errors.lastname" class="text-danger">{{ this.errors.lastname[0] }}</span>
        </div>
        <div class="form-group mt-3">
            <label for="email1">E-mail</label>
            <input @keyup="cleanErrors" type="text" id="email1" name="email" class="form-control" v-model="form.email" />
            <span v-if="this.errors.email" class="text-danger">{{ this.errors.email[0] }}</span>
        </div>
        <div class="form-group">
            <label for="password1">Password</label>
            <input @keyup="cleanErrors" type="password" id="password1" name="password" class="form-control" v-model="form.password" />
            <span v-if="this.errors.password" class="text-danger">{{ this.errors.password[0] }}</span>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password confirmation</label>
            <input @keyup="cleanErrors" type="password" id="password_confirmation" name="password_confirmation" class="form-control" v-model="form.password_confirmation" />
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success btn-lg">Register</button>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'

    export default {
        data(){
            return{
                form:{
                    firstname: null,
                    lastname: null,
                    email:null,
                    password:null,
                    password_confirmation:null
                },
                errors:{}
            }
        },
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
