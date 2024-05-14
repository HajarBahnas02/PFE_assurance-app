<template>
    <div>
      <h2>Tableau de bord de l'administrateur</h2>
      
      <div>
        <h3>Demandes non traités :</h3>
        <table>
          <thead>
            <tr>
              <th>matricule</th>
              <th>Type motorisation</th>
              <th>puissance Fiscale</th>
              <th>modele</th>
              <th>date de mise en circulation</th>
              <th>Valeur à nouveau </th>
              <th>Valeur Vénale</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="vehicule in vehicules" :key="vehicule.matricule">
              <td>{{ vehicule.type_motorisation.nom }}</td>
              <td>{{ vehicule.puissance_fiscale }}</td>
              <td>{{ vehicule.modele.nom }}</td>
              <td>{{ vehicule.date }}</td>
              <td>{{ vehicule.valeurNouveau }}</td>
              <td>{{ vehicule.valeurVénale }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div>
        <h3>Demandes  traitées :</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom du client</th>
              <th>Véhicule</th>
              <th>Offre</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="demande in demandesNonTraitees" :key="demande.id">
              <td>{{ demande.id }}</td>
              <td>{{ demande.nomClient }}</td>
              <td>{{ demande.vehicule }}</td>
              <td>En attente</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "../router/axios-config.js";

  export default {
    data() {
      return {
        demandesTraitees: [
          { id: 1, nomClient: 'Jean Dupont', vehicule: 'Renault Clio', offre: '500€' },
          { id: 2, nomClient: 'Marie Leblanc', vehicule: 'Peugeot 208', offre: '600€' },
          { id: 3, nomClient: 'Pierre Durand', vehicule: 'Toyota Corolla', offre: '550€' }
        ],
        demandesNonTraitees: [
          { id: 4, nomClient: 'Sophie Martin', vehicule: 'Ford Fiesta' },
          { id: 5, nomClient: 'Michel Lambert', vehicule: 'Volkswagen Golf' }
        ],
        vehicules: []
      };
    },
    mounted() {
    this.fetchVehicules();
  },
  methods: {
    fetchVehicules() 
    {
      axios.get('vehicules/non-traites')
        .then(response => {
          this.vehicules = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des véhicules :', error);
        });
    }
  }
}
  </script>
  
  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  th {
    background-color: #f2f2f2;
    text-align: left;
  }  </style>
  
