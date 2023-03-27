<template>
  <button>Add client</button>
  <p class="text-center" v-if="isLoading">Loading clients...</p>
  <ul v-for="c in clients" :key="c.id">
    <li><a :href="'/clients/' + c.id">{{c.name}} {{c.surname}}</a> &nbsp; <button>Edit</button> <button>Delete</button></li>
  </ul>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const clients = ref([]);

onMounted(() => {
    fetch('http://localhost:8000/api/clients').then(response => response.json()).then(data => {
        console.log(data);
        clients.value = data;
    });
});
</script>

<style scoped>
ul {
    list-style: none;
    padding: 0px;
}
</style>