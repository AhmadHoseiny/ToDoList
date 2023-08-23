<script setup>

import { reactive } from "vue";
import axios from 'axios';
import { useRouter } from 'vue-router';
import ListItem from '../components/ListItem.vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

const router = useRouter()
const sessionStorage = window.sessionStorage;
const itemToBeCreated = reactive({
    name: ''
})
const itemsList = reactive({
    items: []
})


const handleCreatingItem = () => {
    let userID = sessionStorage.getItem('userID');
    axios.post('http://127.0.0.1:8000/api/items/create/'.concat(userID), itemToBeCreated)
            .then(response => {
                // console.log(response.data);
                itemToBeCreated.name = '';
                getAllItems();
            })
            .catch(error => {
                // console.log(error);
                itemToBeCreated.name = '';
                alert(error.response.data.message);
            });
}

const getAllItems = () => {
    let userID = sessionStorage.getItem('userID');
    axios.get('http://127.0.0.1:8000/api/items/index/'.concat(userID))
            .then(response => {
                // console.log(response.data);
                itemsList.items = [];
                for(let i=0 ; i<response.data.length ; i++){
                    itemsList.items.push(response.data[i]);
                }
            })
            .catch(error => {
                // console.log(error);
                alert(error.response.data.message);
            });
}
getAllItems();



</script>


<template>

    <Header />

    <div class="flex justify-center items-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="h-auto  w-96 bg-gray-800 shadow dark:border dark:border-gray-700 rounded-lg p-4">
            
            <h2 class="text-xl font-bold mt-2 mb-5 text-[#FFFFFF] text-center">To Do List</h2>
            <div class="mb-8">
                <form class="w-full max-w-sm">
                    <div class="flex items-center border-b border-white-500 py-2">
                        <input class="appearance-none bg-transparent border-none w-full text-white mr-3 py-1 px-2 leading-tight focus:outline-none" v-model="itemToBeCreated.name" type="text" placeholder="Add a new task" aria-label="Full name">
                        <button class="flex-shrink-0 bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 text-sm text-white py-1 px-2 rounded" @click.prevent="handleCreatingItem" type="button">
                            Create
                        </button>
                    </div>
                </form>
            </div>

             
            <ul class="my-4 ">
                <list-item @update="getAllItems" v-for="(item, index) in itemsList.items" :item="item" :key="index" />
            </ul>


        </div>
    </div>

    <Footer />
</template>


<style scoped>

</style>