<template>
    <div>
        <div class="card mt-5">
            <div class="card-header text-center">
                <h1>{{ this.number }}</h1>
            </div>
            <div class="card-body text-center">
                <a @click.prevent="plus" href="#" class="btn btn-success btn-lg">+</a>
                <a @click.prevent="minus" href="#" class="btn btn-danger btn-lg">-</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                number:100
            }
        },
        methods:{
            plus(){
                this.number += 1
            },
            minus(){
                this.number -= 1
            }
        }
    }
</script>

<style scoped lang="scss">
    h1{
        font-size: 100px;
    }
</style>
