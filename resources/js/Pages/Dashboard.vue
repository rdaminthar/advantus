<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import moment from 'moment';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Login Temperatures</h2>
                        <hr>
                        <div class="row pb-5">
                                <div class="offset-md-8 col-md-2">
                                    <button v-on:click="sorting()" class="btn btn-warning btn-sm">Hottest First</button>
                                </div>
                                
                                <div class="col-md-2">
                                    <button @click="sorting" class="btn btn-primary btn-sm">Reset Order</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <div class="row mx-auto">
                                    <h3>Colombo</h3>
                                </div>
                                <div class="row" v-for="(temp) in temperatures" v-on:sorting="sorting()">
                               
                                    <div class="col-md-5" v-if="temp.city_id === 1">{{ dateTime(temp.created_at) }}</div>
                                    <div class="col-md-2" v-if="temp.city_id === 1">{{ temp.celcius }}&deg;C</div>
                                    <div class="col-md-2" v-if="temp.city_id === 1">{{ temp.fahrenheit }}&deg;F</div>
                                
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mx-auto">
                                        <h3>Melbourne</h3>
                                    </div>
                                    <div class="row" v-for="(temp) in temperatures">
                               
                                        <div class="col-md-5" v-if="temp.city_id === 2">{{ dateTime(temp.created_at) }}</div>
                                        <div class="col-md-2" v-if="temp.city_id === 2">{{ temp.celcius }}&deg;C</div>
                                        <div class="col-md-2" v-if="temp.city_id === 2">{{ temp.fahrenheit }}&deg;F</div>
                                
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
    
</template>
<script>
    export default {
       
        props: {
            temperatures: Object
        },
        methods: {
            dateTime(value) {
                return moment(value).format('ddd, DD MMMM YYYY, H:mm');
            },

            sorting() {
                axios.get('/dashboard_sorted').then(function (response){
                    console.log(response);
                   
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        
    }
</script>