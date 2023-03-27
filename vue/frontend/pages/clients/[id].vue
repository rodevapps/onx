<template>
  <h3>{{client.name}} {{client.surname}}</h3>
  <p>Worker: {{client.worker.name}} {{client.worker.surname}}</p>
  <p>Orders:</p>
  <p>Cars:</p>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const route = useRoute();
const client = ref({});

const id = route.params.id;

onMounted(() => {
    fetch('http://localhost:8000/api/clients/' + id).then(response => response.json()).then(data => {
        console.log(data);
        client.value = data[0];
    });
});
</script>

<style scoped>
</style>
