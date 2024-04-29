

<template>
  <div v-if="loading">Chargement en cours...</div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <router-view ></router-view>
</template>
<style>
*{
  margin: 0;
  padding: 0;
  color: none;
}
</style>

<script setup>
</script>
 