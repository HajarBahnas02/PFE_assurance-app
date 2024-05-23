<template>
    
   <!----> <div class="sidebar">
        <div class="sidebar-layout">
        <img src="../assets/logo.png" width="50px" height="50px" alt="logo">
        <span class="logo-text">Shahed</span></div>
        <ul>
        <li @click="selectSection('non-traites')">Contrats Non Traités</li>
        <li @click="selectSection('traites')">Contrats Traités</li>
      </ul>
    </div>
  </template>
  
  <script>

  export default {
   
    methods: {
      selectSection(section) {
        this.$emit('select', section);
      }
    }
  }
  </script>
  
  <style scoped>
    .sidebar {
      padding-bottom: 20%;
        width: 20%; /* Prend toute la largeur de son conteneur parent */
        height: 100vh; /* Prend toute la hauteur de la vue */
        background: linear-gradient(135deg, #004085, #009879);        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Ombre pour donner de la profondeur */
      }
  
  .sidebar-layout{
    padding-bottom: 12%;
  }
  .sidebar h2 {
    margin-top: 0;
  }
  
  .sidebar ul {
    list-style-type: none;
    padding: 10%;
  }
  .sidebar ul li {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 10px;
    display: block;
    width: 100%;
    text-align: center;
    border-radius: 5px;
    transition: background 0.3s ease;
  }
  
  .sidebar ul li:hover {
    background: rgba(241, 239, 239, 0.2);
    color:black ;
  }
  .sidebar ul li {
    padding: 7% 10px;
    cursor: pointer;
  }
  .dash {
    margin-left: 20%; /* Make space for the sidebar */
    padding: 20px;
  }
  
  .sidebar ul li:hover {
transform: scale(1.1);
background-color: azure;
  }
  </style>
  