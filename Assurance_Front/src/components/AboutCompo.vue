<template>
  <div class="admin-comp">
    <Sidebar @select="handleSelect" />
    <div class="dash">
      <nav class="navbar">
        <div class="navbar-brand">

          <a href="#">Panel administrateur {{ dateActuelle }} </a>
      
        </div>
        <div class="navbar-menu">
          <a href="#" @click.prevent="goToProfile">Mon Compte</a>
        </div>
      </nav>
      <div :class="{ 'disable-interactions': showForm }" class="content">
        <div class="cards-container">
          <div class="card">
            <div class="card-details">
              <h3 class="text-title">Devis Non Traités</h3>
              <p class="text-body">{{ contratsNonTraites.length }}</p>
            </div>
          </div>
          <div class="card">
            <div class="card-details">
              <h3 class="text-title">Devis Traités</h3>
              <p class="text-body">{{ contratsTraites.length }}</p>
            </div>
          </div>
        </div>
        <h2 v-if="selectedSection === 'non-traites'">
          Contrats avec Véhicules Non Traités
        </h2>
        <table
          v-if="selectedSection === 'non-traites'"
          id="contrats-non-traites"
          class="display"
          style="width: 100%"
        >
          <thead>
            <tr>
              <th>ID Devis</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Téléphone</th>
              <th>Email</th>
              <th>Matricule Véhicule</th>
              <th>Date Début</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="contrat in contratsNonTraites" :key="contrat.id_devis">
              <td>{{ contrat.id_devis }}</td>
              <td>{{ contrat.client_nom }}</td>
              <td>{{ contrat.client_prenom }}</td>
              <td>{{ contrat.client_telephone }}</td>
              <td>{{ contrat.client_email }}</td>
              <td>{{ contrat.matricule }}</td>
              <td>{{ contrat.date_debut }}</td>
              <td><button @click="showTraiterForm(contrat)">Afficher</button></td>
            </tr>
          </tbody>
        </table>

        <h2 v-if="selectedSection === 'traites'">Contrats avec Véhicules Traités</h2>
        <table
          v-if="selectedSection === 'traites'"
          id="contrats-traites"
          class="display"
          style="width: 100%"
        >
          <thead>
            <tr>
              <th>ID Devis</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Téléphone</th>
              <th>Email</th>
              <th>Matricule Véhicule</th>
              <th>Date Début</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="contrat in contratsTraites" :key="contrat.id_devis">
              <td>{{ contrat.id_devis }}</td>
              <td>{{ contrat.client_nom }}</td>
              <td>{{ contrat.client_prenom }}</td>
              <td>{{ contrat.client_telephone }}</td>
              <td>{{ contrat.client_email }}</td>
              <td>{{ contrat.matricule }}</td>
              <td>{{ contrat.date_debut }}</td>
            </tr>
          </tbody>
        </table>

        <Modal :isVisible="showForm" @close="closeForm">
          <form @submit.prevent="traiterContrat" class="styled-form">
            <!-- Formulaire de traitement -->
            <!-- Contenu du formulaire -->
          </form>
        </Modal>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "../router/axios-config.js";
import Sidebar from "./Sidebar.vue";
import Modal from "./Modal.vue";

export default {
  name: "ContratsTable",
  components: {
    Sidebar,
    Modal,
  },
  data() {
    return {
      montant_initial: 0,
      montant_essentiel: 0,
      montant_premium: 0,
      contratsNonTraites: [],
      contratsTraites: [],
      showForm: false,
      selectedContrat: null,
      selectedSection: "non-traites", // Section sélectionnée par défaut
      vehiculeInfo: {
        matricule: "",
        puissanceFiscale: 0,
        dateMiseEnCirculation: "",
        valeurNeuve: 0,
        valeurVenale: 0,
        marque_nom: "",
        modele_nom: "",
        type_motorisation_nom: "",
        dateActuelle: new Date().toLocaleDateString(),

      },
      clientInfo: {}, //ajouter les inormations du client
    };
  },
  mounted() {
    this.fetchContratsNonTraites();
    this.fetchContratsTraites();
    this.fetchVehiculeInfo();
  },
  methods: {
    fetchContratsNonTraites() {
      axios
        .get("admin/clients-devis-non-traités")
        .then((response) => {
          this.contratsNonTraites = response.data;
          console.log(this.contratsNonTraites);
          this.$nextTick(() => {
            $("#contrats-non-traites").DataTable();
          });
        })
        .catch((error) => {
          console.error("There was an error fetching the non-traite contracts!", error);
        });
    },
    fetchContratsTraites() {
      axios
        .get("admin/clients-devis-traités")
        .then((response) => {
          this.contratsTraites = response.data;
          this.$nextTick(() => {
            $("#contrats-traites").DataTable();
          });
        })
        .catch((error) => {
          console.error("There was an error fetching the traite contracts!", error);
        });
    },
    showTraiterForm(contrat) {
      this.selectedContrat = contrat;
      this.fetchVehiculeInfo(contrat.matricule);
      this.showForm = true;
    },
    fetchVehiculeInfo(matricule) {
      axios
        .get(`/vehicules/${matricule}`)
        .then((response) => {
          this.vehiculeInfo = response.data;
          if (this.vehiculeInfo.marque_id) {
            this.fetchMarqueName(this.vehiculeInfo.marque_id);
          }
          if (this.vehiculeInfo.modele_id) {
            this.fetchModelName(this.vehiculeInfo.modele_id);
          }
          if (this.vehiculeInfo.type_motorisation_id) {
            this.fetchTypeMotorisation(this.vehiculeInfo.type_motorisation_id);
          }
        })
        .catch((error) => {
          console.error("There was an error fetching the vehicle info!", error);
        });
    },
    fetchMarqueName(marqueId) {
      axios
        .get(`marques/${marqueId}/nom`)
        .then((response) => {
          this.vehiculeInfo.marque_nom = response.data.nom;
        })
        .catch((error) => {
          console.error("There was an error fetching the marque name!", error);
        });
    },
    fetchModelName(modeleId) {
      axios
        .get(`models/${modeleId}/nom`)
        .then((response) => {
          this.vehiculeInfo.modele_nom = response.data;
        })
        .catch((error) => {
          console.error("There was an error fetching the model name!", error);
        });
    },
    fetchTypeMotorisation(typeMotorisationId) {
      axios
        .get(`TypeMotorisation/${typeMotorisationId}/nom`)
        .then((response) => {
          this.vehiculeInfo.type_motorisation_nom = response.data;
        })
        .catch((error) => {
          console.error("There was an error fetching the type motorisation!", error);
        });
    },
    closeForm() {
      this.showForm = false;
      this.selectedContrat = null;
      this.vehiculeInfo = {};
    },
    traiterContrat() {
      const formData = {
        montant_initial: this.montant_initial,
        montant_essentiel: this.montant_essentiel,
        montant_premium: this.montant_premium,
      };
      axios
        .put(`/devis/${this.selectedContrat.id_devis}`, formData)
        .then((response) => {
          alert("Les montants ont été enregistrés avec succès.");
          this.closeForm();
          this.fetchContratsNonTraites();
          this.fetchContratsTraites();
        })
        .catch((error) => {
          console.error(
            "Une erreur s'est produite lors de l'enregistrement des montants.",
            error
          );
        });
      axios
        .put(`/vehicules-statut/${this.selectedContrat.matricule}`)
        .then((response) => {
          alert("Le statut du véhicule a été mis à jour avec succès.");
          this.closeForm();
          this.fetchContratsNonTraites();
          this.fetchContratsTraites();
        })
        .catch((error) => {
          console.error("There was an error updating the vehicule status!", error);
        });
    },
    sendEmailToClient(clientI) {
      console.log(clientI);
      axios
        .post(`/send-email/${clientI}`)
        .then((response) => {
          alert("Email envoyé avec succès au client.");
        })
        .catch((error) => {
          console.error("Une erreur s'est produite lors de l'envoi de l'email.", error);
        });
    },
    handleSelect(section) {
      this.selectedSection = section;
    },
    goToProfile() {
      // Logique pour naviguer vers la page du profil de l'administrateur
      // Cela pourrait être une redirection vers une autre route, par exemple :
      this.$router.push("/admin-profile");
    },
  },
};
</script>
/* Conteneur général pour ajuster le style de la page */
<style scoped>
.cards-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2rem; /* Ajoute de l'espace entre les cartes */
  padding: 20px; /* Optionnel : Ajoute du padding autour des cartes */
}

.card {
  width: 190px;
  height: 254px;
  border-radius: 20px;
  background: #f5f5f5;
  position: relative;
  padding: 1.8rem;
  border: 2px solid #c3c6ce;
  transition: 0.5s ease-out;
  overflow: visible;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center; /* Centre le texte à l'intérieur de la carte */
}

.card-details {
  color: black;
  height: 100%;
  gap: 0.5em;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.card-button {
  transform: translate(-50%, 125%);
  width: 60%;
  border-radius: 1rem;
  border: none;
  background-color: #008bf8;
  color: #fff;
  font-size: 1rem;
  padding: 0.5rem 1rem;
  position: absolute;
  left: 50%;
  bottom: 0;
  opacity: 0;
  transition: 0.3s ease-out;
}

.text-body {
  color: rgb(134, 134, 134);
}

/*Text*/
.text-title {
  font-size: 1.5em;
  font-weight: bold;
}

/*Hover*/
.card:hover {
  border-color: #008bf8;
  box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}

.card:hover .card-button {
  transform: translate(-50%, 50%);
  opacity: 1;
}
.admin-comp {
  display: flex;
  background-color: #f0f2f5;
}

.dash {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #004085;
  padding: 1rem;
  color: #ffffff;
}

.navbar a {
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
}

.navbar a:hover {
  text-decoration: underline;
}

.content {
  padding: 20px;
}

.cards-container {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.card {
  width: 190px;
  height: 254px;
  border-radius: 20px;
  background: #ffffff;
  position: relative;
  padding: 1.8rem;
  border: 2px solid #c3c6ce;
  transition: 0.5s ease-out;
  overflow: visible;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
}

.card-details {
  color: black;
  text-align: center;
}

.text-body {
  color: rgb(134, 134, 134);
}

.text-title {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 0.5em;
}

/* Styles pour les tables */
table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 1em;
  text-align: left;
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
}

thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
}

th,
td {
  padding: 12px 15px;
  border: 1px solid #dddddd;
}

tbody tr:nth-child(even) {
  background-color: #f3f3f3;
}

tbody tr:nth-child(odd) {
  background-color: #ffffff;
}

tbody tr:hover {
  background-color: #f1f1f1;
  cursor: pointer;
}

button {
  background-color: #008bf8;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #006bb8;
}

h2 {
  color: #333;
  margin-top: 30px;
  font-size: 1.5em;
  border-bottom: 2px solid #009879;
  padding-bottom: 0.5em;
}

/* Styles pour la modal */
.styled-form {
  display: flex;
  flex-direction: column;
}

.styled-form .form-group {
  margin-bottom: 1em;
}

.styled-form label {
  margin-bottom: 0.5em;
  color: #333333;
}

.styled-form input[type="text"],
.styled-form input[type="date"],
.styled-form input[type="number"] {
  width: 100%;
  padding: 0.5em;
  border: 1px solid #dddddd;
  border-radius: 5px;
}

.styled-form button {
  align-self: flex-end;
  padding: 0.5em 1em;
  border: none;
  border-radius: 5px;
  background-color: #008bf8;
  color: #ffffff;
  cursor: pointer;
}

.styled-form button:hover {
  background-color: #006bb8;
}
</style>
