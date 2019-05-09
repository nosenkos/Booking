<template>
    <div class="steps">
        <div class="step_1" v-show="this.step==1">
<!--            DATE PICKER     -->
            <div class="booking-list mt-5 mb-5">
                <div class="row">
                    <div class="col-6">
                        <flat-pickr
                            v-model="startdate"
                            :config="startdate_config"
                            class="form-control"
                            placeholder="Select date"
                            name="date"
                            @on-change="start_date_change"
                        >
                        </flat-pickr>
                    </div>
                    <div class="col-6">
                        <flat-pickr
                            v-model="enddate"
                            :config="enddate_config"
                            class="form-control"
                            id="endDate"
                            placeholder="Select date"
                            name="date">
                        </flat-pickr>
                    </div>
                </div>
            </div>
        </div>
        <div class="step_2" v-show="this.step==2">
<!--            PAYMENT     -->
            <form action="/charge" method="post" id="payment-form" v-show="!isLoading">
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <button>Submit Payment</button>
            </form>
            <div v-show="isLoading" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="step_3" v-show="this.step==3">
<!--            THANKS FOR YOUR MONEY, SUCKERS!     -->
            <h3>Thank you!</h3>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button :disabled="!enddate" id="next" type="button" @click.prevent="nextStep" class="btn btn-success">Next</button>
            </div>
        </div>
    </div>
</template>

<script>
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import axios from 'axios'

    export default {
        components:{
            flatPickr
        },
        props:['property'],
        data(){
            return {
                isLoading: false,
                step:1,
                startdate: new Date().toLocaleString(),
                enddate: null,
                startdate_config:{
                    'minDate': new Date()
                },
                enddate_config:{
                    'minDate': new Date()
                },
                stripe: null,
                elements: null,
                style : {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                },
                card: null,
                form:null

            }
        },
        methods:{
            start_date_change(e){
                this.enddate_config.minDate = new Date(e)
                document.getElementById('endDate')._flatpickr.open()
            },
            nextStep(){
                this.step += 1
            },
            prevStep(){
                this.step += 1
            },
            stripeTokenHandler(token) {
                let id = token.id
                axios.post('/charge',{
                    'token': id,
                    "start": this.startdate,
                    "end": this.enddate,
                    "price": this.property.price_per_day
                }).then((response)=>{
                   this.isLoading = false
                   this.nextStep()
                }).catch((errors)=>{

                })
            }
        },
        mounted(){
            this.stripe = Stripe('pk_test_Y76tdFx8EtjbaE4sStat4AMY')
            this.elements = this.stripe.elements()
            this.card = this.elements.create('card', {style: this.style})
            this.card.mount('#card-element')

            this.card.addEventListener('change', (event) => {
                let displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            this.form = document.getElementById('payment-form');

            this.form.addEventListener('submit', (event) => {
                event.preventDefault();

                this.isLoading = true

                this.stripe.createToken(this.card).then((result) => {
                    if (result.error) {
                        let errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        this.stripeTokenHandler(result.token);
                    }
                });
            });
        }
    }
</script>

<style scoped>
    .StripeElement {
        width:100%;

        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
