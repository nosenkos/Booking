<template>
    <div class="row">
        <div class="col-4 mt-5">
            <input v-model="newTask" type="text" class="form-control" placeholder="Enter new task...">
            <br>
            <a @click.prevent="addTask" href="#" class="btn btn-success">Add task</a>
            <br><br>
            <ul v-if="this.taskList.length" class="list-unstyled">
                <li v-for="(task,key) in this.taskList" class="alert alert-dark">
                    {{ task }}
                    <a @click.prevent="removeTask(key)" href="#" class="float-right btn btn-sm btn-danger">x</a>
                </li>
            </ul>
        </div>
        <div class="mt-5">
            <h3>{{ stardata }}. Count: {{ countStarData }}</h3>
            <ul class="list-unstyled" v-if="this.starWars.length">
                <li v-for="person in this.starWars" class="alert alert-dark">
                    <h4>{{ person.name }}</h4>
                    Age: {{ person.birth_year }}<br>
                    Eye color: {{ person.eye_color }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapState, mapGetters } from 'vuex'

    export default {
        data(){
            return {
                newTask:null,
                taskList:[],
                starWars:[]
            }
        },
        computed: {
            ...mapState([
                'stardata'
            ]),
            ...mapGetters([
                'countStarData'
            ])
        },
        methods:{
            addTask(){
                if(this.newTask!=null){
                    this.taskList.push(this.newTask)
                    this.newTask = null
                }
            },
            removeTask(key){
                this.taskList.splice(key,1);
            },
            getStarWarsData(){
                axios.get('https://swapi.co/api/people').then((response)=>{
                    this.starWars = response.data.results
                }).catch((errors)=>{
                    console.log(errors)
                })
            }
        },
        mounted(){
            this.getStarWarsData()
        }
    }
</script>

<style scoped>

</style>
