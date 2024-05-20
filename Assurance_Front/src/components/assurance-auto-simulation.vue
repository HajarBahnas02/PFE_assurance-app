<template>
  <div :class="{ 'disable-interactions': showForm }">
    <h2>Contrats avec Véhicules Non Traités</h2>
    <table id="contrats-non-traites" class="display" style="width:100%;">
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
          <td>
            <button @click="showTraiterForm(contrat)">Afficher</button>
            <button @click="sendEmailToClient(contrat.client_id)">Envoyer Email</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "../router/axios-config.js";
import Modal from './Modal.vue';

export default {
  name: 'ContratsTable',
  components: {
    Modal
  },
  data() {
    return {
      montant_initial: 0,
      montant_essentiel: 0,
      montant_premium: 0,
      contratsNonTraites: [],
      showForm: false,
      selectedContrat: null,
      vehiculeInfo: {},
      clientInfo: {}
    };
  },
  mounted() {
    this.fetchContratsNonTraites();
    this.fetchVehiculeInfo();
  },
  methods: {
    fetchContratsNonTraites() {
      axios.get('admin/clients-devis-non-traites')
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
    fetchVehiculeInfo(matricule) {
      axios.get(`/vehicules/${matricule}`)
        .then(response => {
          this.vehiculeInfo = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the vehicle info!", error);
        });
    },
    showTraiterForm(contrat) {
      this.selectedContrat = contrat;
      this.fetchVehiculeInfo(contrat.matricule);
      this.showForm = true;
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
        montant_premium: this.montant_premium
      };
      axios.put(`/devis/${this.selectedContrat.id_devis}`, formData)
        .then(response => {
          alert('Les montants ont été enregistrés avec succès.');
          this.closeForm();
          this.fetchContratsNonTraites();
        })
        .catch(error => {
          console.error("Une erreur s'est produite lors de l'enregistrement des montants.", error);
        });

      axios.put(`/vehicules-statut/${this.selectedContrat.matricule}`)
        .then(response => {
          alert('Le statut du véhicule a été mis à jour avec succès.');
          this.closeForm();
          this.fetchContratsNonTraites();
        })
        .catch(error => {
          console.error("There was an error updating the vehicle status!", error);
        });
    },
    sendEmailToClient(clientId) {
      axios.post(`/send-email/${clientId}`)
        .then(response => {
          alert('Email envoyé avec succès au client.');
        })
        .catch(error => {
          console.error("Une erreur s'est produite lors de l'envoi de l'email.", error);
        });
    }
  }
};
</script>

<style>
.disable-interactions {
  pointer-events: none;
}
</style>
