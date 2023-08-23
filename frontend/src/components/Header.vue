<script setup>
    import { useRouter } from 'vue-router';
    const router = useRouter()
    const sessionStorage = window.sessionStorage;
    const handleLogOut = () => {
        sessionStorage.removeItem('userID');
        router.push({
             name: 'login' 
        });
    }
</script>

<template>
  <header class="bg-[#0c2e46] w-full flex justify-between items-center pl-10 pr-10 pt-5 pb-5">
        
        <a href="#" class="flex items-center text-white font-bold text-xl">
            <img class="w-8 h-8 mr-2" src="..\assets\images\logo-sign-in.png" alt="logo">
            To Do List
        </a>
        <nav class="navigation">
            <button class="pl-2 pr-2 pt-1 pb-1 bg-gray-200 rounded-lg text-[#0c2e46] text-lg font-semibold addTrans" @click="handleLogOut">Log out</button>
        </nav>
</header>


</template>


<style scoped>
.addTrans {
    transition: all 0.25s ease;
}
.addTrans:hover {
    transform: scale(1.1);
}
</style>