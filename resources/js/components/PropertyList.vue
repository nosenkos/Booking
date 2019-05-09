<template>
    <div>
        <div class="row">
            <div class="col-4" v-for="post in properties.data" :key="post.id">
                <div class="card">
                    <div class="card-body">
                        <a :href="'/property/' + post.id">
                            <img class="img-fluid" :src="getObjectImage(post)" />
                            <div class="object-title">{{ post.title }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <pagination :data="properties" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                properties:{}
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('/api/v2/properties?page=' + page).then((response) => {
                    this.properties = response.data;
                });
            },
            getObjectImage(object){
                if(object.media && Object.keys(object.media).length){
                    return object.media[0].image.medium.url;
                }
                return "https://placehold.it/300x150?text=Image%20should%20be%20here"
            }
        },
        mounted(){
            this.getResults()
        }
    }
</script>

<style scoped>
    .card{
        margin:20px 0px;
    }
</style>
