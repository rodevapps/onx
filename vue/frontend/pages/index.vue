<template>
  <button><NuxtLink to="/clients/add">Add client</NuxtLink></button>
  <p class="text-center" v-if="isLoading">Loading clients...</p>
  <ul v-if="!isLoading">
    <li v-for="c in clients" :key="c.id">
      <NuxtLink :to="'/clients/' + c.id">{{c.name}} {{c.surname}}</NuxtLink> &nbsp;
      <button><NuxtLink :to="'/clients/' + c.id + '/edit'">Edit</NuxtLink></button>
      <button><NuxtLink :to="'/clients/' + c.id + '/delete'">Delete</NuxtLink></button>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const isLoading = ref(true);
const clients = ref([]);

onMounted(() => {
    fetch('http://localhost:8000/api/clients').then(response => response.json()).then(data => {
        console.log(data);
        clients.value = data;
        isLoading.value = false;
    });
});
</script>

<style scoped>
ul {
    list-style: none;
    padding: 0px;
}
</style>