<template>
  <div>
    <Layout />
    <div class="tarification">
  <div class="plan" v-for="(offre, index) in offres" :key="index">
      <div class="inner">
          <span class="pricing">
              <span>
                  {{ offre.montant }} <small>DH</small>
              </span>
          </span>
          <p class="title">{{ offre.nomOffre }}</p>
          <p class="info">Les garanties incluses:</p>
          <ul class="features">
              <li v-for="(garantie, i) in offre.garanties" :key="i">
                  <span class="icon-tarif">
                      <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0 0h24v24H0z" fill="none"></path>
                          <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                      </svg>
                  </span>
                  <span><strong>{{ garantie }}</strong></span>
              </li>
              <div>
                  <p class="info"><strong>Assistances </strong></p>
                  <ul class="features">
                    <li v-for="assistance in assistances" :key="assistance.id">
                      <input
                      class="assistance-check"
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
                    <select class="custom-select"
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
                    <div v-if="selectedOptionAssistanceDescriptions[index]" class="selected-offre">
                      <p><Strong>Description de l'option d'assistance:</Strong> {{ selectedOptionAssistanceDescriptions[index] }}</p>
                    </div>
                  </div>
                </div>
        
          </ul>
          <div class="action">
              <button class="button" @click="selectOffre(offre)">Sélectionner</button>
            </div> 
      </div>
  </div></div>
  <div class="parent-container">
    <div v-if="selectedOffre" class="card-selec">
        <h3>Détails de l'offre sélectionnée :</h3>
        <h4>Nom de l'offre : <span><strong>{{ selectedOffre.nomOffre }}</strong></span></h4>
        <h4>Montant : <span><strong>{{ selectedOffre.montant }} DH</strong></span> </h4>
        <h4>Garanties : </h4>  
        <ul>
          <li v-for="(garantie, key) in selectedOffre.garanties" :key="key">
            <span class="icon-tarif">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                </svg>
            </span>
            <span><strong>{{ garantie }}</strong></span>
          </li>
        </ul> 
        <button class="btn">Valider</button>
    </div>
</div>    

</div>

  <Footer />

</template>

<script>
import axios from "../router/axios-config.js";
import Layout from "../views-home/Layout.vue";
import Footer from "../views-home/Footer.vue";

export default {
  components: {
    Footer,
    Layout,
  },
  data() {
    return {
      offres: [],
      montants: {},
      assistances: [], // Liste des assistances
    selectedAssistanceIds: [], // ID des assistances sélectionnées pour chaque offre
    optionsAssistances: [], // Options d'assistance pour chaque assistance sélectionnée
    selectedOptionAssistanceIds: [], // ID des options d'assistance sélectionnées pour chaque offre
    selectedOptionAssistanceDescriptions: [],
    selectedOffre: null, // Offre sélectionnée

    };
  },
  props: {
    clientId: {
      type: String,
      required: true,
    },
  },
  mounted() {
    console.log("Client ID from URL:", this.clientId); // Afficher l'ID du client dans la console
    this.fetchMontants();
    this.fetchAssistances();
  },
  methods: {
      selectOffre(offre) {
  this.selectedOffre = offre;
},
    fetchMontants() {
      axios
        .get(`/clients/${this.clientId}/montants`)
        .then((response) => {
          this.montants = response.data;
          this.fetchOffres();
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des montants:", error);
        });
    },
    fetchOffres() {
      axios
        .get("/offres")
        .then((response) => {
          this.offres = response.data.map((offre) => {
              const garanties = offre.garanties_selectionnees.map((garantie) => garantie.garantie.nomTypeGarantie);
            let montant = null;
            if (offre.nomOffre === 'Formule initiale') {
              montant = this.montants.montant_initial;
            } else if (offre.nomOffre === 'Formule essentielle') {
              montant = this.montants.montant_essentiel;
            } else if (offre.nomOffre === 'Formule premium') {
              montant = this.montants.montant_premium;
            }
            
            return {
              ...offre,
              montant: montant || 'Montant non disponible',
              garanties: garanties

            };
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
  fetchOptionsAssistances(index, assistanceId, selectedOptionAssistanceId) {
  axios
    .get(`/assistances/${assistanceId}/optionsAssistances`)
    .then((response) => {
      this.optionsAssistances.splice(index, 1, response.data);
      // Vérifier si l'option d'assistance sélectionnée est définie et est dans la liste d'options
      if (
        selectedOptionAssistanceId &&
        this.optionsAssistances[index].some(option => option.id === selectedOptionAssistanceId)
      ) {
        // Récupérer l'index de l'option d'assistance sélectionnée
        const selectedOptionIndex = this.optionsAssistances[index].findIndex(option => option.id === selectedOptionAssistanceId);
        // Mettre à jour l'index de l'option d'assistance sélectionnée dans le tableau
        this.selectedOptionAssistanceIds.splice(index, 1, selectedOptionAssistanceId);
        // Récupérer et afficher la description de l'option d'assistance sélectionnée
        this.fetchOptionAssistanceDescription(selectedOptionAssistanceId, index);
      } else {
        // Si aucune option d'assistance n'est sélectionnée ou si elle n'est pas dans la liste d'options, afficher la description de la première option
        const firstOptionId = this.optionsAssistances[index][0].id;
        this.selectedOptionAssistanceIds.splice(index, 1, firstOptionId);
        this.fetchOptionAssistanceDescription(firstOptionId, index);
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
      // Extraire directement la description de la réponse
      this.selectedOptionAssistanceDescriptions[index] = response.data.description;
      console.log(this.selectedOptionAssistanceDescriptions[index]);
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

<style>
.parent-container {
  display: flex;
  justify-content: center;
  align-items: center;
}


.btn {
--color: #00A97F;
--color2: rgb(10, 25, 30);
padding: 0.8em 1.75em;
background-color: transparent;
border-radius: 6px;
border: .3px solid var(--color);
transition: .5s;
position: relative;
overflow: hidden;
cursor: pointer;
z-index: 1;
font-weight: 300;
font-size: 17px;
font-family: 'Roboto', 'Segoe UI', sans-serif;
text-transform: uppercase;
background-color: #6558d3 !important;
width: 30%;
height: 50px;
}

.btn::after, .btn::before {
content: '';
display: block;
height: 100%;
width: 100%;
transform: skew(90deg) translate(-50%, -50%);
position: absolute;
inset: 50%;
left: 25%;
z-index: -1;
transition: .5s ease-out;
background-color: var(--color);
}

.btn::before {
top: -50%;
left: -25%;
transform: skew(90deg) rotate(180deg) translate(-50%, -50%);
}

.btn:hover::before {
transform: skew(45deg) rotate(180deg) translate(-50%, -50%);
}

.btn:hover::after {
transform: skew(45deg) translate(-50%, -50%);
}

.btn:hover {
color: var(--color2);
}

.btn:active {
filter: brightness(.7);
transform: scale(.98);
}
*{
color: #000;}
select{
background-color: #bed6fb;
}
/* Ajoutez votre CSS ici */
.vld-offre button {
  color: white;
  border: none;
  border-radius: 5px;
  background-color: #333;
  cursor: pointer;
}
.tarification {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  padding: 20px;
}

:root {
  --color: black;
}
h3 * {
  color: cornflowerblue;
}

body,
html {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.container-tarification {
  display: flex;
  background-color: #ccc;
  flex-wrap: wrap;
}
.cards-tarification {
  width: 100%;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

.card-tarification {
  display: block;
  width: calc(26% - 20px);
  margin: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 15px;
  color: #333;
  transition: transform 0.3s ease;
  background-color: #f9f9f9;
}

.card-tarification:hover {
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

.features {
  list-style: none;
  padding: 0;
}

.features li {
  padding: 8px 0;
  border-bottom: 1px solid #eee;
}

.features li:last-child {
  border-bottom: none;
}
.custom-select {
  margin-left: 70px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.fa-sharp {
  color: rgb(0, 73, 128);
  padding-right: 15px;
}
.features input {
  width: 15px;
  height: 15px;
  margin-right: 12px;
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

.selected-offre {
  padding: 10px;
  margin-bottom: 12px;
  margin-top: 12px;
  margin-left: 15%;
  display: flex;
 /* flex-direction: column;*/
  justify-content: space-between;
  box-shadow: none;
}


.selected-offre h3 {
  color: rgb(0, 0, 0);
  margin-left: 10%;
  font-size: 24px;
  margin-bottom: 10px;
}
.selected-offre li {
  margin-left: 20%;
  margin-bottom: 3%;
}
.card-2 .header {
  background-color: #f3f3f3;
  padding: 10
} 
.card-selec {
  width: 60%;
  margin-bottom: 2%;
  height: auto;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center; 
  align-items: flex-start;     /* Aligne les enfants à gauche */
  overflow: hidden;
  border-radius: 20px;
  padding: 20px;
}
.card-selec h3 {
  z-index: 1;
  color: rgb(235, 16, 16);
  font-size: 2em;
  text-align: center; /* Centre le texte dans le h2 */
  width: 100%;  
}
.card-selec h4 {
  z-index: 1;
  font-size: 1.5em;
  padding-left: 10%;
  margin-bottom: 10px;
  color: rgb(6, 6, 6);
  width: 100%;
  
}
.card-selec span *{
  z-index: 1;
  font-size: 1em;
  color: #000721;
  margin-bottom: 8px;
}

.card-selec ul {
  list-style-type: none; 
  padding-left: 20%;         
}

.card-selec ul li {
  margin-bottom: 5px;
  color: white;
  display: flex;
  align-items: center;
}

.card-selec ul li span {
  margin-right: 15px;
}
.card-selec {
position: relative; /* Assurez-vous que la div parente a une position relative */
}
.card-selec::before {
content: '';
position: absolute;
top: -50%; 
bottom: -50%; 
left: -50%; 
right: -50%;
background-image: linear-gradient(190deg, #1fcac5, #6558d3);
height: 200%; /* Ajustez en fonction de la hauteur du gradient désirée */
width: 200%; 
 /* animation: rotBGimg 5s linear infinite;
transition: all 0.3s linear;
z-index: -1;Assurez-vous que le ::before est derrière le contenu de .card-selec */
}
/*
@keyframes rotBGimg {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}*/
.card-selec h2, .card-selec h3, .card-selec ul, .card-selec .btn {
  z-index: 1;
  color: white;
}
.card-selec  li {
  margin: 9px 0;
}
.card-selec .btn {
  background-color: #6558d3;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  align-items: center;
  cursor: pointer;
  margin:10px 20px 0 60%;
  transition: background-color 0.3s;
}



</style> 
<style>
.plan {
  border-radius: 16px;
  box-shadow: 0 30px 30px -25px rgba(0, 38, 255, 0.205);
  padding: 10px;
  background-color: #fff;
  color: #697e91;
  max-width: 30%;
  display: flex;
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);

  
}

.plan strong {
  font-weight: 600;
  color: #425275;
}

.plan .inner {
  align-items: center;
  padding: 20px;
  padding-top: 40px;
  background-color: #ecf0ff;
  border-radius: 12px;
  transition: transform 0.3s ease;
  position: relative;
}
.inner:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.plan .pricing {
  position: absolute;
  top: 0;
  right: 0;
  background-color: #bed6fb;
  border-radius: 99em 0 0 99em;
  display: flex;
  align-items: center;
  padding: 0.625em 0.75em;
  font-size: 1.25rem;
  font-weight: 600;
  color: #425475;
}

.plan .pricing small {
  color: #707a91;
  font-size: 0.75em;
  margin-left: 0.25em;
}

.plan .title {
  font-weight: 600;
  font-size: 1.25rem;
  color: #425675;
}

.plan .title + * {
  margin-top: 0.75rem;
}

.plan .info + * {
  margin-top: 1rem;
}

.plan .features {
  display: flex;
  flex-direction: column;
}

.plan .features li {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.plan .features li + * {
  margin-top: 0.75rem;
}

.icon-tarif {
  background-color: #1FCAC5;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  border-radius: 50%;
  width: 20px;
  height: 20px;
}

.plan .features .icon-tarif svg {
  width: 14px;
  height: 14px;
}

.plan .features + * {
  margin-top: 1.25rem;
}

.plan .action {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: end;
}

.plan .button {
  background-color: #6558d3 !important;
  border-radius: 6px;
  color: #fff;
  font-weight: 500;
    font-size: 1.125rem;
    text-align: center;
  border: 0;
  outline: 0;
  width: 100%;
  padding: 0.625em 0.75em;
  text-decoration: none;
  cursor: pointer; /* Ajoutez un curseur pointer pour indiquer que c'est cliquable */
}

.plan .button:hover,
.plan .button:focus {
  background-color: #4133b7 !important;
}


</style>    