<template>
  <div>
    <h1>Liste des Offres</h1>
    <div v-for="(offre, index) in offres" :key="index">
      <h2>{{ offre.nomOffre }}</h2>
      <p>Montant : {{ offre.montant }}</p>
      <h3>Garanties :</h3>
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
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des offres:', error);
        });
        axios.get('/assistances')
          .then(response=>
            {
              this.assistances = response.data;
              console.log(this.assistances); 
            })
       .catch(error => {
          console.error('Erreur lors de la récupération des assistances:', error);
        });
    },
  },
};
</script>
