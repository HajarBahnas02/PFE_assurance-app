<template>
  <div class="container">
    <h1 class="title">Espace Client</h1>
    <div v-if="clientInfo" class="client-info">
      <p><strong>Nom:</strong> {{ clientInfo.nom }}</p>
      <p><strong>Prénom:</strong> {{ clientInfo.prenom }}</p>
      <p><strong>Adresse:</strong> {{ clientInfo.email }}</p>
      <p><strong>Email:</strong> {{ clientInfo.adresse }}</p>
      <p><strong>Téléphone:</strong> {{ clientInfo.telephone }}</p>
      <p><strong>Ville:</strong> {{ clientInfo.ville_id }}</p>
      <!-- Ajoutez d'autres champs selon les informations du client -->
    </div>
    <button @click="logout" class="logout-btn">Déconnexion</button>
  </div>
</template>

<script>
import axios from '../router/axios-config.js';

export default {
  name: "EspaceClient",
  data() {
    return {
      clientInfo: null,
    };
  },
  mounted() {
    this.getClientInfo();
  },
  methods: {
    getClientInfo() {
      axios.get('/espace-client/info', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('auth_token')
        }
      })
        .then(response => {
          this.clientInfo = response.data.clientInfo;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des informations du client :', error);
        });
    },
    logout() {
      axios.post("/logout")
        .then(response => {
            // Déconnexion réussie, effectuez les actions nécessaires
            console.log(response.data.message);
            // Rediriger l'utilisateur ou afficher un message de déconnexion réussie
        })
        .catch(error => {
            // Gérer les erreurs de déconnexion
            console.error("Erreur lors de la déconnexion :", error);
        });
    }
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
}

.title {
  font-size: 24px;
  margin-bottom: 20px;
}

.client-info {
  background-color: #f9f9f9;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
}

.client-info p {
  margin: 10px 0;
}

.logout-btn {
  background-color: #f44336;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}

.logout-btn:hover {
  background-color: #d32f2f;
}
</style>
