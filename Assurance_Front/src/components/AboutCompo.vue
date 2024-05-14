<template>
  <div>
    <h1>Gestion des véhicules non traités</h1>
    <div v-for="vehicule in vehicules" :key="vehicule.id" class="vehicule">
      <h2>{{ vehicule.matricule }}</h2>
      <p>Puissance fiscale: {{ vehicule.puissanceFiscale }}</p>
      <p>Date de mise en circulation: {{ vehicule.dateMiseEnCirculation }}</p>
      <p>Valeur neuve: {{ vehicule.valeurNeuve }}</p>
      <p>Valeur vénale: {{ vehicule.valeurVenale }}</p>
      <p>Modèle: {{ vehicule.modele.nom }}</p>
      <p>Type de motorisation: {{ vehicule.type_motorisation.nom }}</p>
      <p>Marque: {{ vehicule.marque.nom }}</p>
      <div>
        <label :for="'montant-initial-' + vehicule.id">
          Formule initiale:
        </label>
        <input
          :id="'montant-initial-' + vehicule.id"
          type="number"
          v-model="vehicule.montants_proposes.montant_initial"
          @change="updateMontantPropose(vehicule.id, 'montant_initial', vehicule.montants_proposes.montant_initial)"
        />
      </div>
      <div>
        <label :for="'montant-essentiel-' + vehicule.id">
          Formule essentielle:
        </label>
        <input
          :id="'montant-essentiel-' + vehicule.id"
          type="number"
          v-model="vehicule.montants_proposes.montant_essentiel"
          @change="updateMontantPropose(vehicule.id, 'montant_essentiel', vehicule.montants_proposes.montant_essentiel)"
        />
      </div>
      <div>
        <label :for="'montant-premium-' + vehicule.id">
          Formule premium:
        </label>
        <input
          :id="'montant-premium-' + vehicule.id"
          type="number"
          v-model="vehicule.montants_proposes.montant_premium"
          @change="updateMontantPropose(vehicule.id, 'montant_premium', vehicule.montants_proposes.montant_premium)"
        />
      </div>
      <label :for="'statut-' + vehicule.id">Statut:</label>
      <select
        :id="'statut-' + vehicule.id"
        v-model="vehicule.statut"
        @change="updateStatut(vehicule)"
      >
        <option value="non_traitee">Non traitée</option>
        <option value="traitee">Traitée</option>
      </select>
      <hr />
    </div>
  </div>
</template>

<script>
import axios from "../router/axios-config.js";

export default {
  data() {
    return {
      vehicules: []
    };
  },
  mounted() {
    this.fetchVehicules();
  },
  methods: {
    fetchVehicules() {
      axios.get('/vehicules')
        .then(response => {
          this.vehicules = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des véhicules :', error);
        });
    },
    updateMontantPropose(vehiculeId, montantType, montantValue) {
      axios.put(`/montants-proposes/${vehiculeId}`, {
        [montantType]: montantValue
      })
      .then(response => {
        console.log('Montant mis à jour:', response.data);
      })
      .catch(error => {
        console.error('Erreur lors de la mise à jour du montant :', error);
      });
    },
    updateStatut(vehicule) {
      axios.put(`/vehicules/${vehicule.id}`, {
        statut: vehicule.statut
      })
      .then(response => {
        console.log('Statut mis à jour:', response.data);
      })
      .catch(error => {
        console.error('Erreur lors de la mise à jour du statut :', error);
      });
    }
  }
}
</script>

<style scoped>
/* Styles spécifiques à cette composante */
.vehicule {
  margin-bottom: 20px;
}
</style>
