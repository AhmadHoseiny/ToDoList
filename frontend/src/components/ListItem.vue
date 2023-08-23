<script setup>
    import axios from 'axios';
    import { defineEmits, defineProps } from "vue";
    const sessionStorage = window.sessionStorage;
    const emit = defineEmits(["update"]);
    const props = defineProps({
        item: {
            type: Object,
            required: true
        }
    })
    const handleUpdate = () => {
        let userID = sessionStorage.getItem('userID');
        let itemID = props.item.id;
        let itemCompleted = props.item.completed==0 ? 1 : 0;
        let urlStr = 'http://127.0.0.1:8000/api/items/update/'.concat(userID).concat('/').concat(itemID);
        let itemToBeUpdated = {
            completed: itemCompleted
        }
        axios.put(urlStr, itemToBeUpdated)
                .then(response => {
                    // console.log(response.data);
                    emit("update");
                })
                .catch(error => {
                    // console.log(error);
                    alert(error.response.data.message);
                });
    }
    const handleDelete = () => {
        let userID = sessionStorage.getItem('userID');
        let itemID = props.item.id;
        let urlStr = 'http://127.0.0.1:8000/api/items/delete/'.concat(userID).concat('/').concat(itemID);
        axios.delete(urlStr)
                .then(response => {
                    // console.log(response.data);
                    emit("update");
                })
                .catch(error => {
                    // console.log(error);
                    alert(error.response.data.message);
                });
    }
</script>


<template>
    <li name="fade" class="mt-4" id="1">
        <div class="flex gap-2">
            <div class="w-full h-12 bg-[#b3c4e3] rounded-[7px] flex justify-between items-center px-3">
                <div class="flex justify-start items-center">
                    <span class=" w-7 h-7 bg-white rounded-full border border-white transition-all cursor-pointer hover:border-[#36d344] flex justify-center items-center" @click="handleUpdate"><font-awesome-icon :class="{'opacity-0': item.completed==0}" class="w-7 h-7" style="color: green" :icon="['fas', 'circle-check']" /></span>
                    <p :class="{ 'line-through': item.completed==1}" class="text-sm ml-4 text-[#5b7a9d] font-semibold">{{ item.name }}</p>
                </div>
                <div>
                    <font-awesome-icon class="hover: cursor-pointer" :icon="['fas', 'trash-can']" @click="handleDelete" style="color: #e00b0b;" />
                </div>
            </div>
        </div>
    </li>
</template>




<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
