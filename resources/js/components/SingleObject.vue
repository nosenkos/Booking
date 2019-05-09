<script>
    import $ from 'jquery'
    import slick from 'slick-carousel'
    import StarRating from 'vue-star-rating'


    export default {
        components:{
            StarRating
        },
        props:['property'],
        data(){
            return {
                media:{},
                plugins:{}
            }
        },
        methods:{

        },
        created(){
            if(this.property.media && Object.keys(this.property.media).length){
                this.media = this.property.media
            }
        },
        mounted(){
            $(".slider").slick();
        }
    }
</script>

<style scoped>

</style>
