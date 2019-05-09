<template>
    <form method="post" action="#" @submit.prevent="send">
        <div class="form-group mt-3">
            <label for="email">E-mail</label>
            <input @keyup="cleanErrors" type="text" id="email" name="email" class="form-control" v-model="form.email" />
            <span v-if="this.errors.email" class="text-danger">{{ this.errors.email[0] }}</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input @keyup="cleanErrors" type="password" id="password" name="password" class="form-control" v-model="form.password" />
            <span v-if="this.errors.password" class="text-danger">{{ this.errors.password[0] }}</span>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success btn-lg">Log in</button>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'

    export default {
        data(){
            return {
                form:{
                    email: null,
                    password: null
                },
                errors:{}
            }
        },
        methods:{
            send(){
                axios.post('/login', this.form).then((response)=>{
                    if(response.data.id){
                        window.location.href = "/";
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
