<template>
  <div :class="{ 'disable-interactions': showForm }" style="margin: auto ; width : 80%">
    <h2>Contrats avec Véhicules Non Traités</h2>
    <table id="contrats-non-traites" class="display" style="width:100%">
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

    <h2>Contrats avec Véhicules Traités</h2>
    <table id="contrats-traites" class="display" style="width:100%">
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
        <h2>Traiter Contrat</h2>
          <div class="form-group">
            <input type="hidden" v-model="selectedContrat.id_client" readonly />
          </div>

        <div class="form-row">
          <div class="form-group">
            <label>ID Devis:</label>
            <input type="text" v-model="selectedContrat.id_devis" readonly />
          </div>
          <div class="form-group">
            <label>Nom:</label>
            <input type="text" v-model="selectedContrat.client_nom" readonly />
          </div>
          <div class="form-group">
            <label>Prénom:</label>
            <input type="text" v-model="selectedContrat.client_prenom" readonly />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Téléphone:</label>
            <input type="text" v-model="selectedContrat.client_telephone" readonly />
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="text" v-model="selectedContrat.client_email" readonly />
          </div>
          <div class="form-group">
            <label>Ville:</label>
            <input type="text" v-model="clientInfo.ville_nom" readonly />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Matricule Véhicule:</label>
            <input type="text" v-model="selectedContrat.matricule" readonly />
          </div>
          <div class="form-group">
            <label>Date Début:</label>
            <input type="date" v-model="selectedContrat.date_debut" readonly />
          </div>
          <div class="form-group">
            <label>Puissance Fiscale:</label>
            <input type="text" v-model="vehiculeInfo.puissanceFiscale" readonly />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Date Mise En Circulation:</label>
            <input type="text" v-model="vehiculeInfo.dateMiseEnCirculation" readonly />
          </div>
          <div class="form-group">
            <label>Valeur Neuve:</label>
            <input type="text" v-model="vehiculeInfo.valeurNeuve" readonly />
          </div>
          <div class="form-group">
            <label>Valeur Vénale:</label>
            <input type="text" v-model="vehiculeInfo.valeurVenale" readonly />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Type de motorisation:</label>
            <input type="text" v-model="vehiculeInfo.type_motorisation_nom" readonly />
          </div>
          <div class="form-group">
            <label>Modèle:</label>
            <input type="text" v-model="vehiculeInfo.modele_nom" readonly />
          </div>
          <div class="form-group">
            <label>Marque:</label>
            <input type="text" v-model="vehiculeInfo.marque_nom" readonly />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Montant initial:</label>
            <input type="number" v-model="montant_initial" min="0" required />
          </div>
          <div class="form-group">
            <label>Montant essentiel:</label>
            <input type="number" v-model="montant_essentiel" min="0" required />
          </div>
          <div class="form-group">
            <label>Montant premium:</label>
            <input type="number" v-model="montant_premium" min="0" required />
          </div>
        </div>
        <button type="submit" @click="sendEmailToClient(selectedContrat.id_client)">Mettre à jour le statut</button>
      </form>
    </Modal>
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
      contratsTraites: [],
      showForm: false,
      selectedContrat: null,
      vehiculeInfo: {
        matricule: '',
        puissanceFiscale: 0,
        dateMiseEnCirculation: '',
        valeurNeuve: 0,
        valeurVenale: 0,
        marque_nom: '',
        modele_nom: '',
        type_motorisation_nom: ''
      },
      clientInfo: {} //ajouter les inormations du client
    };
  },
  mounted() {
    this.fetchContratsNonTraites();
    this.fetchContratsTraites();
    this.fetchVehiculeInfo();
   /* this.fetchClientInfo();*/
    
  },
  methods: {
    fetchContratsNonTraites() {
      axios.get('admin/clients-devis-non-traités')
        .then(response => {
          this.contratsNonTraites = response.data;
          console.log(this.contratsNonTraites);
          this.$nextTick(() => {
            $('#contrats-non-traites').DataTable();
          });
        })
        .catch(error => {
          console.error("There was an error fetching the non-traite contracts!", error);
        });
    },
    fetchContratsTraites() {
      axios.get('admin/clients-devis-traités')
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
      this.fetchVehiculeInfo(contrat.matricule);
      //this.fetchClientInfo(contrat.client_id); 
      this.showForm = true;
    },
    fetchVehiculeInfo(matricule) {
      axios.get(`/vehicules/${matricule}`)
        .then(response => {
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
        .catch(error => {
          console.error("There was an error fetching the vehicle info!", error);
        });
    },
  /*  fetchClientInfo(client_id) {
      axios.get(`clients/${client_id}`)
        .then(response => {
          this.clientInfo = response.data;
          this.fetchVilleName(this.clientInfo.ville_id);
        })
        .catch(error => {
          console.error("There was an error fetching the client info!", error);
        });
    },
    fetchVilleName(villeId) {
      axios.get(`Ville/${villeId}/nom`)
        .then(response => {
          this.clientInfo.ville_nom = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the ville name!", error);
        });
    },*/
    fetchMarqueName(marqueId) {
      axios.get(`marques/${marqueId}/nom`)
        .then(response => {
          this.vehiculeInfo.marque_nom = response.data.nom;
        })
        .catch(error => {
          console.error("There was an error fetching the marque name!", error);
        });
    },

    fetchModelName(modeleId) {
      axios.get(`models/${modeleId}/nom`)
        .then(response => {
          this.vehiculeInfo.modele_nom = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the model name!", error);
        });
    },
fetchTypeMotorisation(typeMotorisationId){
axios.get(`TypeMotorisation/${typeMotorisationId}/nom`)
.then(response => {
  this.vehiculeInfo.type_motorisation_nom = response.data;
})
.catch(error => {
  console.error("There was an error fetching the type motorisation!", error);
});},
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
          this.fetchContratsTraites();
        })
        .catch(error => {
          console.error("Une erreur s'est produite lors de l'enregistrement des montants.", error);
        });

      axios.put(`/vehicules-statut/${this.selectedContrat.matricule}`)
        .then(response => {
          alert('Le statut du véhicule a été mis à jour avec succès.');
          this.closeForm();
          this.fetchContratsNonTraites();
          this.fetchContratsTraites();

        })
        .catch(error => {
          console.error("There was an error updating the vehicule status!", error);
        });
        
    },
sendEmailToClient(clientI) {
  console.log(clientI);

      axios.post(`/send-email/${clientI}`)
        .then(response => {
          alert('Email envoyé avec succès au client.');
        })
        .catch(error => {
          console.error("Une erreur s'est produite lors de l'envoi de l'email.", error);
        });
    },
  }
};
</script>
<style>
.disable-interactions {
  pointer-events: none;
}.styled-form {
  max-width: 900px;
  margin: 0 auto;
}
.form-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.form-group {
  flex: 0 0 32%;
}
label {
  display: block;
  margin-bottom: 5px;
}
input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}
button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  cursor: pointer;
  margin-top: 20px; /* Pour ajouter un espace avant le bouton */
}
button:hover {
  background-color: #0056b3;
}
</style>