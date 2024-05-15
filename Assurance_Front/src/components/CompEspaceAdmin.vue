<template>
  <div>
    <h2>Contrats avec Véhicules Non Traités</h2>
    <table id="contrats-non-traites" class="display" style="width:100%">
      <thead>
        <tr>
          <th>ID Devis</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
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
          <td>{{ contrat.vehicule_matricule }}</td>
          <td>{{ contrat.date_debut }}</td>
          <td><button @click="showTraiterForm(contrat)">Traiter</button></td>
        </tr>
      </tbody>
    </table>

    <h2>Contrats avec Véhicules Traités</h2>
    <table id="contrats-traites" class="display" style="width:100%">
      <thead>
        <tr>
          <th>ID Devis</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
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
          <td>{{ contrat.vehicule_matricule }}</td>
          <td>{{ contrat.date_debut }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Modal for Traiter Form -->
    <div v-if="showForm" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeForm">&times;</span>
        <form @submit.prevent="traiterContrat">
          <h2>Traiter Contrat</h2>
          <div>
            <label>ID Devis:</label>
            <input type="text" v-model="selectedContrat.id_devis" readonly />
          </div>
          <div>
            <label>Nom:</label>
            <input type="text" v-model="selectedContrat.client_nom" readonly />
          </div>
          <div>
            <label>Prénom:</label>
            <input type="text" v-model="selectedContrat.client_prenom" readonly />
          </div>
          <div>
            <label>Téléphone:</label>
            <input type="text" v-model="selectedContrat.client_telephone" readonly />
          </div>
          <div>
            <label>Matricule Véhicule:</label>
            <input type="text" v-model="selectedContrat.vehicule_matricule" readonly />
          </div>
          <div>
            <label>Date Début:</label>
            <input type="date" v-model="selectedContrat.date_debut" readonly />
          </div>
          <div>
            <label>Autres informations sur le véhicule:</label>
            <textarea v-model="vehiculeInfo" readonly></textarea>
          </div>
          <button type="submit">Mettre à jour le statut</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../router/axios-config.js";

export default {
  name: 'ContratsTable',
  data() {
    return {
      contratsNonTraites: [],
      contratsTraites: [],
      showForm: false,
      selectedContrat: null,
      vehiculeInfo: ''
    };
  },
  mounted() {
    this.fetchContratsNonTraites();
    this.fetchContratsTraites();
  },
  methods: {
    fetchContratsNonTraites() {
      axios.get('admin/clients-contrats-non-traités')
        .then(response => {
          this.contratsNonTraites = response.data;
          this.$nextTick(() => {
            $('#contrats-non-traites').DataTable();
          });
        })
        .catch(error => {
          console.error("There was an error fetching the non-traite contracts!", error);
        });
    },
    fetchContratsTraites() {
      axios.get('admin/clients-contrats-traités')
        .then(response => {
          this.contratsTraites = response.data;
          this.$nextTick(() => {
            $('#contrats-traites').DataTable();
          });
        })
        .catch(error => {
          console.error("There was an error fetching the traite contracts!", error);
        });
    },
    showTraiterForm(contrat) {
      this.selectedContrat = contrat;
      this.fetchVehiculeInfo(contrat.vehicule_matricule);
      this.showForm = true;
    },
    fetchVehiculeInfo(matricule) {
      axios.get(`vehicules/${matricule}`)
        .then(response => {
          this.vehiculeInfo = JSON.stringify(response.data, null, 2);
        })
        .catch(error => {
          console.error("There was an error fetching the vehicle info!", error);
        });

    },
    closeForm() {
      this.showForm = false;
      this.selectedContrat = null;
      this.vehiculeInfo = '';
    },
    traiterContrat() {
      axios.put(`/api/vehicule/${this.selectedContrat.vehicule_matricule}/traiter`)
        .then(response => {
          alert('Le statut du véhicule a été mis à jour avec succès.');
          this.closeForm();
          this.fetchContratsNonTraites();
          this.fetchContratsTraites();
        })
        .catch(error => {
          console.error("There was an error updating the vehicle status!", error);
        });
    }
  }
};
</script>

<style>
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4); /* Fond semi-transparent */
  padding-top: 60px; /* Espace supplémentaire en haut */
}

.modal-content {
  background-color: #fefefe; /* Fond du formulaire */
  margin: 5% auto; /* Centrez verticalement et horizontalement */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>