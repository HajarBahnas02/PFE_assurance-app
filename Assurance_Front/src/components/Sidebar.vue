<template>
  <div class="sidebar">
    <div class="sidebar-layout">
      <img src="../assets/logo.png" width="50px" height="50px" alt="logo">
      <span class="logo-text">Shahed</span>
    </div>
    <ul class="sidebar-list">
      <li class="item-admin" @click="selectSection('about')">
        <i class="fas fa-tachometer-alt"></i> Tableau de bord
      </li>
      <li class="item-admin" @click="selectSection('non-traites')">
        <i class='fas fa-file-contract'></i> Devis Non Traités
      </li>
      <li class="item-admin" @click="selectSection('traites')">
        <i class="fa-solid fa-file-signature"></i> Devis Traités
      </li>
      <li class="item-admin" @click="selectSection('contrats')">
        <i class="fas fa-user"></i> Contrats Clients
      </li>
      <li class="item-admin last" @click.prevent="logout">
        <i class="fa fa-sign-out"></i> Déconnexion
      </li>
    </ul>
  </div>
</template>


<script>
export default {
  methods: {
    selectSection(section) {
      if (section === 'about') {
        this.$router.push('/about'); // Naviguer vers la route du tableau de bord
        this.$router.go(0); // Rafraîchir la page actuelle
      } else {
        this.$emit('select', section);
      }
    },
    logout() {
      this.$emit('logout');
    }
  }
}
</script>

<style scoped>
/* Styles de la barre latérale */
.sidebar {
  width: 20%;
  height: 100vh;
  background: linear-gradient(130deg, black, rgb(89, 167, 186));
  padding: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
}

.sidebar-layout {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 10px; /* Ajout de padding en bas du logo */
  border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Bordure inférieure */
}

.sidebar-layout img {
  margin-right: 10px;
}

.logo-text {
  color: white;
  font-size: 1.2em;
}

.sidebar-list {
  list-style-type: none;
  padding: 0;
  flex: 1; /* Prendre tout l'espace disponible */
  display: flex;
  flex-direction: column;
}

.sidebar-list li {
  color: white;
  font-weight: bold;
  margin-right: 10px; 

}

.sidebar-list li i {
  margin-right: 10px; 
  border-color: sandybrown;
  border-width: 1px;
}

li:hover {
  background: black;
  color: black;
}

.item-admin {
  color: white;
  font-weight: bold;
  padding: 20px 10px; 
  border-bottom: 1px solid rgba(255, 255, 255, 0.2); 
}

.item-admin i {
  padding-right: 15px; 
}

.item-admin:hover {
  background: rgba(241, 239, 239, 0.2);
  color: black;
}

i {
  color: red;
}

.last {
  margin-top: auto; /* Pousse cet élément à la fin de la sidebar */
}
</style>
