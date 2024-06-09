<template>
    <div class="admin-comp">
      <Sidebar @select="handleSelect" />
      <div class="dash">
        <nav class="navbar">
          <div class="navbar-brand">
            <a href="#">Aujourd'hui: {{ dateActuelle }}</a>
          </div>
          <div class="navbar-menu">
            <a href="#" >Mon Compte</a>
          </div>
        </nav>
        <div :class="{ 'disable-interactions': showForm }" class="content">
          <div class="cards-container">
            <div class="card" @click="handleSelect('non-traites')">
              <div class="card-details">
  
                <h3 class="text-title">
                  Devis Non Traités              
                </h3>  <i class="icon fas fa-file-contract"></i>
                <p class="number">{{ contratsNonTraites.length }}</p>
              </div>
            </div>
            <div class="card" @click="handleSelect('traites')">
              <div class="card-details">
                <h3 class="text-title">
                  Devis Traités
                </h3>   <i class="icon fas fa-file-signature"></i>
                <p class="number">{{ contratsTraites.length }}</p>
              </div>
            </div>
            
          </div>     
          <h2 v-if="selectedSection === 'non-traites' || selectedSection === null">Contrats avec Véhicules Non Traités</h2>
          <table v-if="selectedSection === 'non-traites' || selectedSection === null" id="contrats-non-traites" class="display" style="width: 100%">
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
              <tr v-for="(contrat, index) in displayedNonTraites" :key="contrat.id_devis">
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
  
          <h2 v-if="selectedSection === 'traites' || selectedSection === null">Contrats avec Véhicules Traités</h2>
          <table v-if="selectedSection === 'traites' || selectedSection === null" id="contrats-traites" class="display" style="width: 100%">
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
              <tr v-for="(contrat, index) in displayedTraites" :key="contrat.id_devis">
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
          <div v-if="selectedSection === 'contrats'">

          <h2>Liste des contrats</h2>
    <table>
      <thead>
        <tr>
          <th>ID Contrat</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Matricule </th>
          <th>Date de Début</th>
          <th>Date de Fin</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(contrat, index) in contrats" :key="index">
          <td>{{ contrat.id_contrat }}</td>
          <td>{{ contrat.nom }}</td>
          <td>{{ contrat.prenom }}</td>
          <td>{{ contrat.telephone }}</td>
          <td>{{ contrat.email }}</td>
          <td>{{ contrat.matricule }}</td>
          <td>{{ contrat.date_debut }}</td>
          <td>{{ contrat.date_fin }}</td>
        </tr>
      </tbody>
    </table>
        </div>
          <Modal :isVisible="showForm" @close="closeForm">
            <form @submit.prevent="traiterContrat" class="styled-form">
              <h2>Traiter Contrat</h2>
              <div class="form-group">
                <input type="hidden" v-model="selectedContrat.id_client" readonly />
              </div>
                 
              <!-- Page 1: Informations du client -->
              <div v-if="currentPage === 1">
                <div class="form-row">
                  <div class="form-group">
                    <label>ID Devis:</label>
                    <input type="text" v-model="selectedContrat.id_dev" readonly />
                  </div>
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
                  <div class="form-group">
                    <label>Date de naissance:</label>
                    <input type="date" v-model="clientInfo.date_naissance" readonly />
                  </div>
                </div>
              </div>
  
              <!-- Page 2: Informations du véhicule -->
              <div v-if="currentPage === 3">
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
              </div>
              <div v-if="currentPage === 2">
                <div class="form-group">
                  <label>Garanties:</label>
                  <ul>
                    <li v-for="(garantie, index) in garanties" :key="index">
                      {{ garantie.nomTypeGarantie }} - {{ garantie.optionNom }}
                    </li>
                  </ul>
                </div>
              </div>
  
              <!-- Navigation Buttons -->
              <div class="form-actions">
                <button type="button" v-if="currentPage > 1" @click="previousPage">Précédent</button>
                <button type="button" v-if="currentPage < 3" @click="nextPage">Suivant</button>
                <button type="submit" v-if="currentPage === 3">Enregistrer</button>
              </div>
            </form>
          </Modal>
  
        </div>
      </div>
      <div v-if="loading" class="spinner-overlay">
        <div class="spinner"></div>
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
      currentPage: 1,
      totalPages: 2,
      montant_initial: 0,
      montant_essentiel: 0,
      montant_premium: 0,
      contratsNonTraites: [],
      contratsTraites: [],
      showForm: false,
      selectedContrat: null,
      selectedSection: null,
      garanties: [],

      vehiculeInfo: {
        matricule: "",
        puissanceFiscale: 0,
        dateMiseEnCirculation: "",
        valeurNeuve: 0,
        valeurVenale: 0,
        marque_nom: "",
        modele_nom: "",
        type_motorisation_nom: "",
        contrats: [],
      },
      clientInfo: {
        ville_nom: "",
        date_naissance: "",
      },
      dateActuelle: new Date().toLocaleDateString(),
      loading: false,
    };
  },
  mounted() {
    this.fetchContratsNonTraites();
    this.fetchContratsTraites();
    this.fetchContrats();
  },
  computed: {
    displayedNonTraites() {
      return this.selectedSection === 'non-traites'
        ? this.contratsNonTraites
        : this.contratsNonTraites.slice(0, 3);
    },
    displayedTraites() {
      return this.selectedSection === 'traites'
        ? this.contratsTraites
        : this.contratsTraites.slice(0, 3);
    },
  },
  methods: {
    async fetchContrats() {
      try {
        const response = await axios.get('/contrats');
        this.contrats = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des contrats:', error);
      }
    },
  nextPage() {
    if (this.currentPage < 3) {
      this.currentPage++;
    }
  },
  previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    fetchContratsNonTraites() {
      this.loading = true;
      axios
        .get("admin/clients-devis-non-traités")
        .then((response) => {
      this.contratsNonTraites = response.data.map(contrat => ({
        ...contrat,
        id_client: contrat.id_client,
        id_devis: contrat.id_devis,
        id_dev:contrat.id_dev
      }));
    })
        .catch((error) => {
          console.error("There was an error fetching the non-traite contracts!", error);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    fetchContratsTraites() {
      this.loading = true;
      axios
        .get("admin/clients-devis-traités")
        .then((response) => {
          this.contratsTraites = response.data;
        })
        .catch((error) => {
          console.error("There was an error fetching the traite contracts!", error);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    showTraiterForm(contrat) {
      this.selectedContrat = contrat;
      this.fetchVehiculeInfo(contrat.matricule);
      this.fetchClientInfo(contrat.id_client);
      this.getGaranties(contrat.id_dev);
      this.showForm = true;
    },
    fetchClientInfo(id_client) {
      axios
        .get(`clients/${id_client}`)
        .then((response) => {
          this.clientInfo = { ...this.clientInfo, ...response.data };
          console.log("Client Info:", this.clientInfo);
        })
        .catch((error) => {
          console.error("There was an error fetching the client info!", error);
        });
    },
    getGaranties(devisId) {
      axios.get(`/devis/${devisId}/garanties`)
        .then(response => {
          this.garanties = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchVehiculeInfo(matricule) {
      axios
        .get(`/vehicules/${matricule}`)
        .then((response) => {
          if (Array.isArray(response.data) && response.data.length > 0) {
            const vehiculeData = response.data[0];
            console.log("Full response data:", vehiculeData);
            this.vehiculeInfo = vehiculeData;
            if (this.vehiculeInfo.modele_id) {
              this.fetchModelName(this.vehiculeInfo.modele_id);
            }
            if (this.vehiculeInfo.marque_id) {
              console.log("Marque ID:", this.vehiculeInfo.marque_id);
              this.fetchMarqueName(this.vehiculeInfo.marque_id);
            }
            if (this.vehiculeInfo.type_motorisation_id) {
              this.fetchTypeMotorisation(this.vehiculeInfo.type_motorisation_id);
            }
          } else {
            console.log("The response data is not an array or the array is empty.");
          }
        })
        .catch((error) => {
          console.error("Une erreur s'est produite lors de la récupération des informations du véhicule !", error);
        });
    },
    fetchMarqueName(marqueId) {
      axios
        .get(`marques/${marqueId}/nom`)
        .then((response) => {
          console.log("Marque Name Response:", response.data);
          this.vehiculeInfo.marque_nom = response.data;
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
    async traiterContrat() {
  this.loading = true;
  const formData = {
    montant_initial: this.montant_initial,
    montant_essentiel: this.montant_essentiel,
    montant_premium: this.montant_premium,
  };

  try {
   
        // Mettre à jour les montants
    const devisResponse = await axios.put(`/devis/${this.selectedContrat.id_devis}`, formData);
    console.log("Devis updated successfully!", devisResponse.data);
    alert("Les montants ont été enregistrés avec succès.");
 
    //Envoyer le message whtssap
    const whatsappResponse = await axios.post(`/send-whatssap`, {
      clientId: this.selectedContrat.id_client,
      devisId: this.selectedContrat.id_dev
    },  {timeout: 10000}, );
    console.log("WhatsApp message sent successfully!", whatsappResponse.data);
    alert("Message WhatsApp envoyé avec succès au client.");

    // Envoyer l'email au client
    const emailResponse = await axios.post(`send-email`, {
      clientId: this.selectedContrat.id_client,
      devisId: this.selectedContrat.id_dev
    },{timeout: 10000});
    console.log(emailResponse.data);
    console.log("Email sent successfully!", emailResponse.data);
    alert("Email envoyé avec succès au client.");

     // Mettre à jour le statut du véhicule
     const vehiculeResponse = await axios.put(`/vehicules-statut/${this.selectedContrat.matricule}`, { timeout: 10000 });
    console.log("Vehicule status updated successfully!", vehiculeResponse.data);
  
    this.closeForm();
    this.fetchContratsNonTraites();
    this.fetchContratsTraites();
  } catch (error) {
    console.error("An error occurred while processing the contract:", error);
    alert("Une erreur s'est produite lors du traitement du contrat.");
  } finally {
    this.loading = false;
  }
},
    handleSelect(section) {
      this.selectedSection = section;
    },
  },
};
</script>
 
  <style scoped>
  .btn-right {
    float: right;
  }
  .spinner-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  
  .spinner {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  .card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 30%;
  }
  
  .card:hover {
    transform: scale(1.05);
  }
  
  .card-details {
    text-align: center;
  }
  
  .card .text-title {
    font-size: 1.5em;
    margin-bottom: 10px;
  }
  
  .card .icon {
    font-size: 3em;
    margin-bottom: 10px;
  }
  
  .card .number {
    font-size: 2em;
    color: #009879;
  }
  
  .number {
    font-size: 2em;; 
    font-weight: bold;
    color: black;
    font-weight: bold;
  }
  
  .icon {
    position: absolute;
    top: 30px;
    right: 10px;
  }
  
  .card-details p {
    margin-top: 10px;
    color: rgb(243, 8, 8);
    font-size: 1em; 
  }
  .text-title {
    margin-top: 0;
    margin-bottom: 10px;
    font-size: 1.2em;
    font-weight: bold;
    display: flex; /* Pour aligner l'icône et le texte sur la même ligne */
    align-items: center; /* Pour centrer verticalement */
  }
  
  .number {
    font-weight: bold;
    font-size: 1.5em;
  }
  
  .icon {
    color: #3091c7;
    font-size: 1em; /* Réduire légèrement la taille de l'icône */
    margin-right: 5px;
  }
  
  .text-title {
    font-size: 1.5em;
    font-weight: bold;
  }
  
  .text-body {
    color: rgb(134, 134, 134);
  }
  
  .card:hover {
    border-color: #008bf8;
    box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
  }
  
  .admin-comp {
    display: flex;
    background-color: #f0f2f5;
    height: 100vh;
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
    background-color: #3091c7;
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
    background-color: #9ddbff;
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
