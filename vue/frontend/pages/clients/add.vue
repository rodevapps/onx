<template>
  <button><NuxtLink to="/">All clients</NuxtLink></button>
  <br /><br />
  <form @submit.prevent="onSubmit()">
    <input type="text" placeholder="Name" v-model="client.name" /><br />
    <input type="text" placeholder="Surname" v-model="client.surname" /><br />
    <input type="submit" value="Add new client" />
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue';

import requestData from '../../functions/common.ts';

const client = ref({name: '', surname: '', worker_id: 1});

const onSubmit = async () => {
    console.log(client.value);

    requestData("http://localhost:8000", "POST", client.value).then(data => {
        console.log(data);
    });

    for (const property in client.value) {
        client.value[property] = '';
    }

    console.log('Form submitted.');

    //await navigateTo({ path: '/' });
}
</script>

<style scoped>
</style>