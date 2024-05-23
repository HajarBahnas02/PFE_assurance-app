<template>
    <div class="min-h-screen flex flex-col">
      <!-- Sidebar -->
      <div class="flex flex-shrink-0 bg-gray-800 p-4 text-white">
        <div class="flex flex-col w-64">
          <div class="flex items-center justify-center h-16">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
          </div>
          <nav class="mt-10">
            <router-link to="/dashboard" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</router-link>
            <router-link to="/users" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Users</router-link>
            <router-link to="/stats" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Stats</router-link>
          </nav>
        </div>
      </div>
      <!-- Main content -->
      <div class="flex-grow bg-gray-100 p-6">
        <router-view></router-view>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Dashboard',
  };
  </script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  