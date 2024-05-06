<template>
  <div>
    <div class="cont">
      <div class="side"></div>
      <div class="container">
        <div class="card card-2" v-for="(offre, index) in offres" :key="index">
          <div class="header">
            <h2>{{ offre.nomOffre }}</h2>
            <center class="price">{{ offre.montant }}</center>
            <div class="duration">
              <button @click="changePriceOptimal(offre, 2814.21)">1 an</button>
              <button @click="changePriceOptimal(offre, 1407.11)">6 mois</button>
            </div>
            <ul>
              <li v-for="(garantie, key) in offre.garanties" :key="key">
                {{ garantie }}
              </li>
            </ul>
          </div>    
          <div class="">
          <h2 class="">Assisstance</h2>
          <ul class="features">
            <li v-for="assistance in assistances" :key="assistance.id" :value="assistance.id">
              {{ assistance.nomAssistance}}
            </li>
          </ul>
          </div>
          <ul class="assistances-list">
            <li v-for="item in optionsAssistances" :key="item.assistance.id">
              <h3>{{ item.assistance.nomAssistance }}</h3>
              <ul class="options-list">
                <li v-for="option in item.options" :key="option.id">
                  {{ option.nomOption }}
                </li>
              </ul>
            </li>
          </ul>
          <center><button class="btn-sel">Sélectionner</button></center>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../router/axios-config.js";

export default {
  data() {
    return {
      offres: [],
    };
  },
  mounted() {
    this.fetchOffres();
    this.fetchOptionsAssistances();
  },
  methods: {
    fetchOffres() {
      axios.get('/offres')
        .then(response => {
          // Réinitialiser la liste des offres
          this.offres = [];
          // Parcourir les données des offres
          response.data.forEach(offre => {
            // Créer un objet offre temporaire
            let offreTemp = {
              nomOffre: offre.nomOffre,
              montant: offre.montant,
              garanties: []
            };
            // Parcourir les garanties sélectionnées pour cette offre
            offre.garanties_selectionnees.forEach(garantieSelectionnee => {
              // Ajouter le nom de la garantie à la liste des garanties de cette offre
              offreTemp.garanties.push(garantieSelectionnee.garantie.nomTypeGarantie);
            });
            // Ajouter l'offre temporaire à la liste des offres
            this.offres.push(offreTemp);
          });
          axios.get('/assistances')
      .then(response => {
        this.assistances = response.data;
        this.assistances.forEach(assistance => {
          axios.get(`/optionAssistances?id_assistance=${assistance.id}`)
            .then(response => {
              this.optionsAssistances.push({ assistance: assistance, options: response.data });
            })
            .catch(error => {
              console.error('Erreur lors de la récupération des options d\'Assistance:', error);
            });
        });
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des assistances:', error);
      });
        })
    },
    changePriceOptimal(price) {
      document.querySelector(".price-optimal").textContent = price + "Dhs";
    },
    selectionner(offre) {
      // Code pour sélectionner cette offre
      console.log("Offre sélectionnée:", offre);
    }
  },
};
</script>

<style>
:root {
  --color: black;
}

body,
html {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.container {
  width: 90%;
  margin: auto;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}


.card {
  width: calc(26% - 20px);
  margin: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 15px;
  color: #333;
  transition: transform 0.3s ease;
  background-color: #f9f9f9;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.header h2 {
  color: var(--color);
  margin-top: 0;
  text-align: center;
  font-size: 24px;
  margin-bottom: 10px;
}

.price {
  font-size: 24px;
  font-weight: bold;
  margin: 10px 0;
  text-align: center;
  color: red;
}

.duration {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.duration button {
  background: red;
  border: 1px solid white;
  color: white;
  padding: 5px 10px;
  margin-right: 5px;
  cursor: pointer;
  text-align: center;
}

.duration button:first-child,
.duration button:last-child {
  border-radius: 25px;
}

.duration button:last-child {
  margin-right: 0;
}

.features {
  list-style: none;
  padding: 0;
}

.features li {
  padding: 5px 0;
  border-bottom: 1px solid #eee;
}

.features li:last-child {
  border-bottom: none;
}

.fa-sharp {
  color: green;
}

.btn-sel {
  border: none;
  padding: 10px 20px;
  background-color: red;
  color: white;
  font-size: larger;
  border-radius: 10px;
  transition-duration: 0.5s;
  display: block;
  margin: 0 auto;
}

.btn-sel:hover {
  background-color: blue;
  cursor: pointer;
}

.card-2 {
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-color: #ececec; /* Couleur de fond ajoutée */
  border: 1px solid #ccc;
  box-shadow: none;
}

.card-2 .header {
  background-color: #f3f3f3;
  padding: 10px;
  border-bottom: 1px solid #ccc;
  border-radius: 8px 8px 0 0;
}

.card-2 .header h2 {
  margin-bottom: 0;
}

.card-2 .price {
  margin-top: 0;
  margin-bottom: 20px;
  text-align: center;
}

.card-2 .duration {
  margin-bottom: 10px;
  text-align: center;
}

.card-2 .duration button {
  background-color: #ff6600;
  border-color: #ff6600;
  color: #fff;
  cursor: pointer;
}

.card-2 .duration button:hover {
  background-color: #cc5500;
  border-color: #cc5500;
}

.card-2 .features li {
  border-bottom: 1px solid #ccc;
}

.card-2 .features li:last-child {
  border-bottom: none;
}

.card-2 .btn-sel {
  background-color: #ff6600;
  border: none;
  color: #fff;
  cursor: pointer;
}

.card-2 .btn-sel:hover {
  background-color: #cc5500;
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .card {
    width: calc(50% - 20px);
  }
}

@media (max-width: 576px) {
  .card {
    width: calc(100% - 20px);
  }
}


.container-v {
  width: 80%;
  margin: auto;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.card-v {
  width:90%;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  flex-direction: column; /* Alignement vertical */
}

.card-v img {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
}

.btn-verti {

  padding: 10px 20px;
  margin-left: 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

@media (min-width: 768px) {
  .card-v {
    flex-direction: row;
    align-items: center; /* Réinitialisation de l'alignement */
  }

  .card-v img {
    max-width: 100%;
    margin-right: 20px; /* Espacement entre l'image et le texte */
    margin-bottom: 0; /* Pour supprimer l'espacement inutile */
  }
}

/* Couleurs modifiées */
.card-v {
  background-color: #f9f9f9; /* Fond de carte */
}

.btn-verti {
  background-color: #28a745; /* Couleur de fond du bouton */
  border: 1px solid #28a745; /* Bordure du bouton */
}

.btn-verti:hover {
  background-color: #218838; /* Couleur de fond du bouton au survol */
  border: 1px solid #218838; /* Bordure du bouton au survol */
}
</style>

