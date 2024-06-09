<template>
  <div class="container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="../assets/logo.png" alt="Logo" class="logo">
        <span class="logo-text">Shahed</span>
      </div>
      <ul class="sidebar-list">
        <li @click="selectSection('home')">
          <i class="fas fa-home"></i> Accueil
        </li>
        <li @click="selectSection('client-info')">
          <i class="fas fa-user"></i> Informations Client
        </li>
        <li @click="selectSection('contrats')">
          <i class='fas fa-file-contract'></i> Contrats
        </li>
      
        <li @click="selectSection('payment')">
          <i class="fas fa-credit-card"></i> Paiement
        </li>
        <li @click.prevent="logout">
          <i class="fa fa-sign-out"></i> Déconnexion
        </li>
      </ul>
    </aside>

    <main class="main-content">
      <div v-if="selectedSection === 'home'">
        <h1>Bonjour, {{ clientInfo.nom }}</h1> 
 
       <p class="phrase-assurance">
        Votre satisfaction est notre priorité, accédez facilement à vos informations et gérez vos contrats en toute simplicité.</p>
        <div class="container-cards">
        <div class="card-paiment">
          <div class="card-detailspai">
            <p class="text-title">Espèce</p>
            <p class="text-body"> Se présenter à l'entreprise</p>
          </div>
          <button   @click="showMap" class="card-buttonpai">Voir plus</button>
        </div>  
        <div class="card-paiment">
          <div class="card-detailspai">
            <p class="text-title">Chéque</p>
            <p class="text-body">Voir plus de détails</p>
          </div>
          <button class="card-buttonpai"> Voir plus</button>
        </div>
        <div class="card-paiment">
          <div class="card-detailspai">
            <p class="text-title">Virement</p>
            <p class="text-body">Voir plus de détails</p>
          </div>
          <button class="card-buttonpai">Voir plus</button>
        </div>
      </div>
      <div v-if="showingMap" class="map-container">
        <iframe
          width="800"
          height="350"
          style="border:0"
          loading="lazy"
          allowfullscreen
          :src="mapSrc"
        ></iframe>
      </div> 
      </div>
      <div v-if="selectedSection === 'client-info' && clientInfo" class="client-info">
        <h1 class="title">Informations Client</h1>
        <form @submit.prevent="updateClientInfo">
          <div class="form-group">
            <label>Nom:</label>
            <input type="text" v-model="clientInfo.nom" readonly />
          </div>
          <div class="form-group">
            <label>Prénom:</label>
            <input type="text" v-model="clientInfo.prenom" readonly />
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="email" v-model="clientInfo.email" :class="{ 'editable': canEdit }" />
          </div>
          <div class="form-group">
            <label>Date de naissance:</label>
            <input type="text" v-model="clientInfo.date_naissance" />
          </div>
          <div class="form-group">
            <label>Téléphone:</label>
            <input type="text" v-model="clientInfo.telephone" />
          </div>
          <div class="form-group">
            <label>Ville:</label>
            <input type="text" v-model="clientInfo.ville_nom" />
          </div>
          <button type="submit" class="update-btn">Mettre à jour</button>
        </form>
      </div>
   
      <div v-if="selectedSection === 'contrats'">
        <h1 class="title">Liste des contrats du client</h1>
        <table class="contrats-table">
            <thead>
                <tr>
                    <th>ID Contrat</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Montant</th>
                    <th>Télécharger Contrat</th> <!-- Nouvelle colonne pour le bouton de téléchargement -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="contrat in contrats" :key="contrat.id_contrat">
                    <td>{{ contrat.id_contrat }}</td>
                    <td>{{ contrat.date_debut }}</td>
                    <td>{{ contrat.date_fin }}</td>
                    <td>{{ contrat.montant_assurance }}</td>
                    <td class="center-cell">
                      <button @click="generatePDF(contrat)" class="download-btn">Télécharger PDF</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

      <div v-if="selectedSection === 'payment'" class="payment-section">
        <h1 class="title">Mode de Paiement</h1>
        <form @submit.prevent="handlePayment" class="payment-form">
          <label for="payment-method">Choisissez un mode de paiement:</label>
          <select v-model="paymentMethod" id="payment-method"  class="payment-select">
            <option value="" disabled selected>Sélectionner un mode de paiement</option>
            <option value="credit-card">Carte de crédit</option>
            <option value="paypal">PayPal</option>
            <option value="bank-transfer">Virement bancaire</option>
          </select>
          <button type="submit" class="pay-btn">Payer</button>
        </form>
      </div>
    </main>
  </div>
  
</template>
<script>
import axios from '../router/axios-config.js';
import jsPDF from 'jspdf';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import 'jspdf-autotable';

export default {
  setup() {       
            toast.success('Votre devis est en cours de traitement,vous recevez dans quelques instants votre tarficications par votre email',{
                autoClose: 6000,
            }); 
    },
  name: "EspaceClient",
  data() {
    return {
      clientInfo: null,
      contrats: [],
      devisList: [],
      selectedSection: 'client-info',
      showingMap: false,
      mapSrc: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.363887992167!2d-4.998885184469148!3d34.03277062508237!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd9f8be93b1bc963%3A0x92bf8b736eebeae7!2sOCTOBOT%20CONSULTING%20%26%20TRAINING!5e0!3m2!1sfr!2sma!4v1636371182945!5m2!1sfr!2sma"
   
    };
  },
  mounted() {
  
    this.getClientInfo();
    this.fetchContrats();
    this.fetchDevis();
  },
  methods: {
  
    showMap() {
      this.showingMap = !this.showingMap;
    },
    async getClientInfo() {
      try {
        const clientId = this.$route.params.clientId;
        const response = await axios.get(`/clients/${clientId}/infos`);
        this.clientInfo = response.data.clientInfo;
      } catch (error) {
        console.error('Erreur lors de la récupération des informations du client:', error);
      }
    },
    async fetchContrats() {
      try {
        const response = await axios.get(`/clients/${this.$route.params.clientId}/contrats`);
        this.contrats = response.data.contrats;
      } catch (error) {
        console.error('Erreur lors de la récupération des contrats:', error);
      }
    },
    async fetchDevis() {
      try {
        const response = await axios.get(`/api/clients/${this.$route.params.clientId}/devis`, { timeout: 10000 });
        this.devisList = response.data.devis;
      } catch (error) {
        console.error('Erreur lors de la récupération des devis:', error);
      }
    },
    selectSection(section) {
      this.selectedSection = section;
    },
    getBase64ImageFromUrl(url, callback) {
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        canvas.height = this.naturalHeight;
        canvas.width = this.naturalWidth;
        ctx.drawImage(this, 0, 0);
        var dataURL = canvas.toDataURL('image/png');
        callback(dataURL);
    };
    img.src = url;
},
generatePDF(contrat) {
      const doc = new jsPDF();

      doc.setTextColor(0, 0, 255);
      doc.setFontSize(16);
      doc.text("Contrat assurance automobile Shahed", doc.internal.pageSize.getWidth() / 2, 40, null, null, 'center');
      doc.setTextColor(0, 0, 0);
      doc.setFontSize(12);

      // Informations du Client
      doc.text("Informations du Client", 10, 50);

      const clientInfo = [
      
        ["Nom", this.clientInfo.nom],
        ["Prénom", this.clientInfo.prenom],
        ["Email", this.clientInfo.email],
        ["Téléphone", this.clientInfo.telephone],
        ["Ville", this.clientInfo.ville_nom],
        ["Date de naissance", this.clientInfo.date_naissance]
      ];

      doc.autoTable({
        startY: 60,
        head: [clientInfo[0]],
        body: clientInfo.slice(1),
      });

      // Détails du Contrat
      doc.text("Détails du Contrat", 10, doc.lastAutoTable.finalY + 10);

      const contratDetails = [
        ["ID Contrat", contrat.id_contrat],
        ["Date Début", contrat.date_debut],
        ["Montant Assurance", contrat.montant_assurance],
        ["Date Fin", contrat.date_fin]
      ];

      doc.autoTable({
        startY: doc.lastAutoTable.finalY + 20,
        head: [contratDetails[0]],
        body: contratDetails.slice(1),
      });

      // Détails de Véhicule
      doc.text("Détails de véhicule", 10, doc.lastAutoTable.finalY + 10);

      const vehicleDetails = [
        ["Matricule", contrat.devis.matricule],
        ["Puissance fiscale", contrat.devis.vehicule.puissanceFiscale],
        ["Date de mise en circulation", contrat.devis.vehicule.dateMiseEnCirculation],
        ["Valeur Neuve", contrat.devis.vehicule.valeurNeuve],
        ["Valeur Vénale", contrat.devis.vehicule.valeurVenale]
      ];

      doc.autoTable({
        startY: doc.lastAutoTable.finalY + 20,
        head: [vehicleDetails[0]],
        body: vehicleDetails.slice(1),
      });

      // Signature et logo de Shahed
      doc.text("Signature", doc.internal.pageSize.getWidth() - 60, doc.internal.pageSize.getHeight() - 40);
      doc.text("Shahed Assurance", doc.internal.pageSize.getWidth() - 60, doc.internal.pageSize.getHeight() - 30);

      doc.save(`contrat_${contrat.id_contrat}.pdf`);
    },

    logout() {
      localStorage.removeItem('auth_token');
      this.$router.push('/login');
    }
  },
};
</script>

<style>

.payment-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.payment-section .title {
  font-size: 24px;
  margin-bottom: 20px;
}

.payment-form {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 400px;
}
.map-container {
  display: flex;
  justify-content: center;
  padding: 2%;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.payment-select {
  width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

.pay-btn {
  padding: 10px 20px;
  background-color: #008bf8;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  align-self: center; /* Centre le bouton horizontalement */
}

.pay-btn:hover {
  background-color: #006bbf;
}
.client-info {
  padding: 20px; /* Ajouter du padding autour du formulaire */
  border-radius: 8px; /* Arrondir les coins si nécessaire */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ajouter une ombre si nécessaire */
}

.form-group {
  margin-bottom: 15px; 
}

.form-group label {
  display: block;
  margin-bottom: 5px; 
  font-weight: bold;
  font-size: 14px;
}

.form-group input {
  width: 60%;
  padding: 10px; /* Ajouter du padding à l'intérieur de l'input */
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.editable{
  width: 60%;
  padding: 10px; /* Ajouter du padding à l'intérieur de l'input */
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.update-btn {
  display: block;
  margin-left: auto; /* Pousser le bouton à droite */
  padding: 10px 20px; /* Ajouter du padding au bouton */
  background-color: #008bf8;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.update-btn:hover {
  background-color: #006bbf; /* Couleur du bouton au survol */
}
.contrats-table {
  width: 100%;
  border-collapse: collapse; /* Supprime les espaces entre les cellules */
  margin-top: 20px;
}

.contrats-table th, .contrats-table td {
  border: 1px solid #ddd;
  padding: 12px; /* Ajoute du padding aux cellules */
  text-align: left; /* Aligne le texte à gauche */
}

.contrats-table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

.contrats-table tr:nth-child(even) {
  background-color: #f9f9f9; /* Couleur de fond pour les lignes paires */
}

.contrats-table tr:hover {
  background-color: #ddd; /* Couleur de fond lors du survol */
}

.center-cell {
  display: flex;
  justify-content: center;
  align-items: center;
}

.download-btn {
  padding: 5px 10px;
  background-color: #008bf8;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.download-btn:hover {
  background-color: #006bbf;
}

@media (min-width: 100px) {
  .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
      max-width: 100% !important;
  }
}
.card-paiment {
  width: 250px;
  height: 200px;
  border-radius: 20px;
  margin-top: 8%;
  position: relative;
  padding: 1.8rem;
  border: 2px solid #c3c6ce;
  transition: 0.5s ease-out;
  overflow: visible;
}
 
 .card-detailspai {
  color: black;
  gap: .5em;
  display: grid;
  place-content: center;
 }

 .card-buttonpai{
  transform: translate(-50%, 125%);
  width: 60%;
  border-radius: 1rem;
  border: none;
  background-color: #eaedf0;
  color: #fff;
  font-size: 1rem;
  gap:23;
  padding: .5rem 1rem;
  position: absolute;
  left: 50%;
  bottom: 0;
  opacity: 0;
  transition: 0.3s ease-out;
 }
 .container-cards {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); 
  justify-content: center; 
  gap: 3%; 
}
.container-cards{
  display: flex;
  justify-content:center;
}

 .text-body {
  color: rgb(134, 134, 134);
 }
 
 /*Text*/
 .text-title {
  font-size: 1.5em;
  font-weight: bold;
  text-align: center;
 }
 
 /*Hover*/
 .card-paiment :hover {
  border-color: #008bf8;
  box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
 }
 
 .card-paiment:hover .card-buttonpai {
  transform: translate(-50%, 50%);
  opacity: 1;
  
 }
.phrase-assurance {
  font-size: 18px;
  font-weight: 700;
  color: #333;
  text-align: center;
  border-radius: 5px;
  padding-bottom: 10px;
}
.container {
  display: flex;
  margin: 0 !important;
  padding: 0 !important;
  width: 100%;
}

.main-content {
    width: 100%; 
    height: 100vh;
    background-image: url('../assets/espace-client.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}
.main-content h1{
  color:#5398b7;
  padding:3%;
  font-family: "Gill Sans Extrabold";
  font-weight: 800;

  
}
.pay-btn {
  background: #3498db;
  color: #ecf0f1;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
}
.download-btn {
  margin-top: 20px;
  float: right;
}
.wrapper {
  display: flex;

}

.sidebar {
  width: 25%;
  background: #5398b7;
  color: #ecf0f1;
  padding: 2%;
}

.sidebar-header {
  display: flex;
  align-items: center;
  background-color: #fff;
  border-radius: 12px;
  padding: 3%;
}

.logo {
  width: 50px;
  height: 50px;
  margin-right: 10px;
}

.logo-text {
  font-size: 20px;
  font-weight: bold;
}

.sidebar-list {
  list-style: none;
  padding: 0;
}

.sidebar-list li {
  margin-top: 8%;
  cursor: pointer;
}

.sidebar-list li:hover {
  background: #fff;
}

.sidebar-list li i {
  margin-right: 10px;
}



.title {
  font-size: 24px;
  margin-bottom: 20px;
}

.client-info p,
h2 {
  margin: 10px 0;
}

.sidebar-list ul {
  list-style: none;
  padding: 0;
}

.sidebar-list li {
  margin: 20px 0;
  padding: 10px;
  background: #bdc3c7;
  border-radius: 5px;
}

.download-btn {
  background: #3498db;
  color: #ecf0f1;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
}

.download-btn:hover {
  background: #2980b9;
}
</style>