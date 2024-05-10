<template>
  <div class="container">
    <div class="card-container">
      <div class="card" v-for="(offre, index) in offres" :key="index">
        <div class="header">
          <h2>{{ offre.nomOffre }}</h2>
          <p class="price">Montant : {{ offre.montant }}</p>
          <h3>Garanties :</h3>
          <ul>
            <li v-for="(garantie, key) in offre.garanties" :key="key">
              <i class="fa-sharp fa-regular fa-circle-check"></i> {{ garantie }}
            </li>
          </ul>
          <div>
            <h1>Assistances</h1>
            <ul>
              <li v-for="assistance in assistances" :key="assistance.id">
                <input
                  type="radio"
                  :id="'assistance-' + assistance.id + '-' + index"
                  :name="'assistance-offre-' + index"
                  v-model="selectedAssistanceIds[index]"
                  :value="assistance.id"
                  @change="handleRadioChange(index, assistance.id)"
                />
                <label :for="'assistance-' + assistance.id + '-' + index">{{
                  assistance.nomAssistance
                }}</label>
              </li>
            </ul>
            <div v-if="selectedAssistanceIds[index]">
              <h2>Options d'assistance</h2>
              <select
                v-model="selectedOptionAssistanceIds[index]"
                @change="handleOptionChange(index)"
              >
                <option
                  v-for="optionAssistance in optionsAssistances[index]"
                  :key="optionAssistance.id"
                  :value="optionAssistance.id"
                >
                  {{ optionAssistance.nomOptionAssistance }}
                </option>
              </select>
              <div v-if="selectedOptionAssistanceDescriptions[index]">
                <h3>Description de l'option d'assistance :</h3>
                <p>{{ selectedOptionAssistanceDescriptions[index] }}</p>
              </div>
            </div>
          </div>
          <center><button class="btn-sel">Sélectionner</button></center>
        </div>
      </div>
    </div>
    <!-- Section pour afficher les détails de l'offre sélectionnée -->
    <div v-if="selectedOffre">
      <h2>Détails de l'offre sélectionnée :</h2>
      <p>Nom de l'offre : {{ selectedOffre.nomOffre }}</p>
      <p>Montant : {{ selectedOffre.montant }}</p>
      <h3>Garanties :</h3>
      <ul>
        <li v-for="(garantie, key) in selectedOffre.garanties" :key="key">
          <i class="fa-sharp fa-regular fa-circle-check"></i> {{ garantie }}
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import axios from "../router/axios-config.js";

export default {
  data() {
    return {
      offres: [],
      assistances: [], // Liste des assistances
      selectedAssistanceIds: [], // ID des assistances sélectionnées pour chaque offre
      optionsAssistances: [], // Options d'assistance pour chaque assistance sélectionnée
      selectedOptionAssistanceIds: [], // ID des options d'assistance sélectionnées pour chaque offre
      selectedOptionAssistanceDescriptions: [], // Descriptions des options d'assistance sélectionnées pour chaque offre
      selectedOffre: null, // Offre sélectionnée
    };
  },
  mounted() {
    this.fetchOffres();
    this.fetchAssistances();
  },
  methods: {
    fetchOffres() {
      axios
        .get("/offres")
        .then((response) => {
          this.offres = [];
          response.data.forEach((offre) => {
            let offreTemp = {
              nomOffre: offre.nomOffre,
              montant: offre.montant,
              garanties: [],
            };
            offre.garanties_selectionnees.forEach((garantieSelectionnee) => {
              offreTemp.garanties.push(garantieSelectionnee.garantie.nomTypeGarantie);
            });
            this.offres.push(offreTemp);
            this.selectedAssistanceIds.push(null);
            this.optionsAssistances.push([]);
            this.selectedOptionAssistanceDescriptions.push(null);
          });
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des offres:", error);
        });
    },
    fetchAssistances() {
      axios
        .get("/assistances")
        .then((response) => {
          this.assistances = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des assistances:", error);
        });
    },
    fetchOptionsAssistances(index, assistanceId) {
      axios
        .get(`/assistances/${assistanceId}/optionsAssistances`)
        .then((response) => {
          this.optionsAssistances.splice(index, 1, response.data);
          if (this.optionsAssistances[index].length > 0) {
            this.selectedOptionAssistanceIds.splice(
              index,
              1,
              this.optionsAssistances[index][0].id
            );
            this.fetchOptionAssistanceDescription(
              this.optionsAssistances[index][0].id,
              index
            );
          }
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération des options d'assistance:",
            error
          );
        });
    },
    fetchOptionAssistanceDescription(optionAssistanceId, index) {
      axios
        .get(`/optionsAssistances/${optionAssistanceId}/description`)
        .then((response) => {
          this.$set(this.selectedOptionAssistanceDescriptions, index, response.data);
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération de la description de l'option d'assistance:",
            error
          );
        });
    },
    handleRadioChange(index, selectedAssistanceId) {
      this.selectedAssistanceIds.splice(index, 1, selectedAssistanceId);
      this.fetchOptionsAssistances(index, selectedAssistanceId);
    },
    handleOptionChange(index) {
      this.fetchOptionAssistanceDescription(
        this.selectedOptionAssistanceIds[index],
        index
      );
    },
  },
};
</script>
<style scoped>
.container {
  width: 100%;

  display: flex;
  justify-content: start;
}

.card-container {
  display: flex;
}
.card {
  display: flex;
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
  width: 90%;
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
