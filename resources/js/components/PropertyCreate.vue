<template>
    <div>
        <h1 class="mt-3">Create object</h1>
        <div class="card">
            <div class="card-body">
                <form method="post" action="#" @submit.prevent="send">

                    <vue-dropzone
                        ref="myVueDropzone"
                        id="dropzone"
                        :options="dropzoneOptions"
                        @vdropzone-success="fileAdded">
                    </vue-dropzone>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" v-model="form.title" />
                        <span class="text-danger" v-if="this.errors.title">{{ this.errors.title[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" v-model="form.description"></textarea>
                        <span class="text-danger" v-if="this.errors.description">{{ this.errors.description[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="price_per_day">Price per day</label>
                        <input type="text" id="price_per_day" class="form-control" v-model="form.price_per_day" />
                        <span class="text-danger" v-if="this.errors.price_per_day">{{ this.errors.price_per_day[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control" v-model="form.country" @change="getStates">
                            <option value="" selected disabled>Select country</option>
                            <option v-for="country in this.countries" :value="country.id">{{ country.name }}</option>
                        </select>
                        <span class="text-danger" v-if="this.errors.country">{{ this.errors.country[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select id="state" class="form-control" v-model="form.state" @change="getCities">
                            <option value="" selected disabled>Select state</option>
                            <option v-for="state in this.states" :value="state.id">{{ state.name }}</option>
                        </select>
                        <span class="text-danger" v-if="this.errors.state">{{ this.errors.state[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <select id="city" class="form-control" v-model="form.city">
                            <option value="" selected disabled>Select city</option>
                            <option v-for="city in this.cities" :value="city.id">{{ city.name }}</option>
                        </select>
                        <span class="text-danger" v-if="this.errors.city">{{ this.errors.city[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="lat">Latitude</label>
                        <input type="text" id="lat" class="form-control" v-model="form.lat" />
                        <span class="text-danger" v-if="this.errors.lat">{{ this.errors.lat[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="lon">Longitude</label>
                        <input type="text" id="lon" class="form-control" v-model="form.lon" />
                        <span class="text-danger" v-if="this.errors.lon">{{ this.errors.lon[0] }}</span>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    import axios from 'axios'
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        data(){
            return {
                form:{
                    title:"",
                    description:"",
                    country:"",
                    state:"",
                    city:"",
                    price_per_day:0,
                    lat:0,
                    lon:0,
                    media:[]
                },
                errors:{},
                countries:{},
                states:{},
                cities:{},
                dropzoneOptions: {
                    url: '/media',
                    thumbnailWidth: 150
                }
            }
        },
        methods:{
            send(){
                axios.post('/property', this.form).then((response)=>{
                    if(response.data.id) {
                        Swal.fire('YAY', 'Property created', 'success').then(() => {
                            window.location.href = '/property'
                        })
                    }
                }).catch((errors)=>{
                    this.errors = errors.response.data.errors
                    Swal.fire('Error','Shit happens','error')
                })
            },
            fileAdded(file,response){
                this.form.media.push(response.id)
            },
            getCountries(){
                this.states = {}
                this.cities = {}
                this.form.city = ""
                axios.get('/api/v2/countries').then((response)=>{
                    this.countries = response.data
                }).catch((errors)=>{
                    console.log(errors)
                })
            },
            getStates(){
                this.cities = {}
                this.form.state = ""
                this.form.city = ""
                axios.get('/api/v2/states/'+this.form.country).then((response)=>{
                    this.states = response.data
                }).catch((errors)=>{
                    console.log(errors)
                })
            },
            getCities(){
                this.form.city = ""
                axios.get('/api/v2/cities/'+this.form.state).then((response)=>{
                    this.cities = response.data
                }).catch((errors)=>{
                    console.log(errors)
                })
            }
        },
        mounted(){
            this.getCountries()
        }
    }
</script>

<style scoped>

</style>
