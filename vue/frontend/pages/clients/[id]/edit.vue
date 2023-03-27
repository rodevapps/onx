<template>
  <button><NuxtLink to="/">All clients</NuxtLink></button>
  <p class="text-center" v-if="isLoading">Loading clients...</p>
  <div v-if="!isLoading">
    <h3>{{client.name}} {{client.surname}}</h3>
    <p>Worker: {{worker.name}} {{worker.surname}}</p>
    <p>Orders:</p>
    <ul>
      <li v-for="o in orders" :key="o.id">{{ o.description }}</li>
    </ul>
    <p>Cars:</p>
    <ul>
      <li v-for="c in cars" :key="c.id">{{ c.name }}</li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const route = useRoute();

const client = ref({});
const worker = ref({});
const orders = ref({});
const cars = ref({});

const isLoading = ref(true);

const id = route.params.id;

onMounted(() => {
    fetch('http://localhost:8000/api/clients/' + id).then(response => response.json()).then(data => {
        console.log(data);

        client.value = data[0];
        worker.value = data[0].worker;
        orders.value = data[0].orders;
        cars.value = data[0].cars;

        isLoading.value = false;
    });
});
</script>

<style scoped>
</style>