<template>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';

const route = useRoute();

const id = route.params.id;

onMounted(async () => {
    fetch('http://localhost:8000/api/clients/' + id).then(response => response.json()).then(data => {
        console.log(data);
    });

    await navigateTo({ path: '/' });
});
</script>

<style scoped>
</style>