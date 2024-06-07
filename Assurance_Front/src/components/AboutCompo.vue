<template>
  <Layout />
  <div class="multi_step_form">
    <div id="msform">
      <!-- Form Progress Steps -->
      <div class="tittle">
        <h2>Obtenir votre devis en quelques minutes</h2>
      </div>
     
      <!-- Form Fields -->
        <fieldset v-if="activeStep === 0">
          <h1>Types de Garanties</h1>
          <div v-for="garantie in garanties" :key="garantie.id" class="garantie">
            <input type="checkbox" :id="'garantie-' + garantie.id" v-model="selectedGaranties" :value="garantie.id">
            <label :for="'garantie-' + garantie.id">{{ garantie.nomTypeGarantie }}</label>
            <div v-if="garantie.options_garanties.length" class="garantie-options">
              <label :for="'options-' + garantie.id">Options:</label>
              <select v-model="selectedOptions[garantie.id]" :id="'options-' + garantie.id">
                <option v-for="option in garantie.options_garanties" :key="option.id" :value="option.id">
                  {{ option.nom }}
                </option>
              </select>
            </div>
          </div>
          <button type="button" @click="prevStep" class="previous_button">Précédent</button>
          <button type="submit">Soumettre</button>
        </fieldset>
    </div>
  </div>
  <Footer />
</template>

<script>
import axios from "../router/axios-config.js";
import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  components: {
    Layout,
    Footer,
  },
  data() {
    return {
      form: {
        matricule: "",
        puissanceFiscale: "",
        dateMiseEnCirculation: "",
        valeurNeuve: "",
        valeurVenale: "",
        marque_id: "",
        modele_id: "",
        type_motorisation_id: "",
      },
      formCl: {
        nom: "",
        prenom: "",
        email: "",
        telephone: "",
        ville_id: "",
        date_naissance: "",
        password: '',
        confirmPassword: ''
      },
      formDev: {
        dateDebut: "",
      },
      marques: [],
      modeles: [],
      typeMotorisations: [],
      puissancesfisc: [],
      villes: [],
      garanties: [],
      selectedGaranties: [],
      selectedOptions: {},
      errors: {},
      errorsCl: {},
      loading: false,
      formSteps: ['Informations Véhicule', 'Informations Client', 'Garanties'],
      activeStep: 0,
    };
  },
  created() {
    this.fetchData();
    this.fetchGaranties();
  },
  computed: {
    today() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, "0");
      const day = String(today.getDate()).padStart(2, "0");
      return `${year}-${month}-${day}`;
    },
    maxBirthDate() {
      const today = new Date();
      const year = today.getFullYear() - 18;
      const month = String(today.getMonth() + 1).padStart(2, "0");
      const day = String(today.getDate()).padStart(2, "0");
      return `${year}-${month}-${day}`;
    },
  },
  methods: {
    async submitGaranties(devisId) {
    for (let garantieId of this.selectedGaranties) {
      let optionId = this.selectedOptions[garantieId] || null; // Récupérer l'option sélectionnée ou null si aucune
      try {
        const response = await axios.post('/devis_garanties', {
          garantie_id: garantieId,
          devis_id: devisId,
          option_id: optionId
        });
        console.log('Garantie enregistrée avec succès:', response.data);
      } catch (error) {
        console.error('Erreur lors de l\'enregistrement de la garantie:', error);
      }
    }
  },
    validateStep1() {
      // Validation logic for step 1
      // ...
    },
    validateStep2() {
      // Validation logic for step 2
      // ...
    },
    nextStep() {
      this.activeStep++;
    },
    prevStep() {
      this.activeStep--;
    },
    fetchData() {
      // Fetch data for vehicle and client form
      // ...
    },
    async fetchGaranties() {
      try {
        const response = await axios.get('/garanties', { timeout: 20000 });
        this.garanties = response.data;
      } catch (error) {
        console.error('Error fetching garanties:', error);
      }
    },
    validateForm() {
      // Form validation logic
      // ...
      return Object.keys(this.errors).length === 0 && Object.keys(this.errorsCl).length === 0;
    },
    async submitForm() {
      this.loading = true;
      if (this.validateForm()) {
        try {
          const vehicleResponse = await axios.post('vehicules', this.form, { timeout: 20000 });
          alert('Véhicule créé avec succès!');

          const clientResponse = await axios.post("/clients_form", this.formCl, { timeout: 20000 });
          const clientId = clientResponse.data.client.id;
          alert('Client ajouté avec succès!');

          const devisData = {
            matricule: this.form.matricule,
            client_id: clientId,
            date_debut: this.formDev.dateDebut,
          };
          const devisResponse = await axios.post('/enregistrer', devisData, { timeout: 20000 });
          alert('Devis créé avec succès!');
          const devisId = devisResponse.data.devis.id;

          await this.submitGaranties(devisId);
          this.resetForm();
          this.$router.push({ name: 'espace-client', params: { clientId: clientId } });
        } catch (error) {
          console.error('Erreur lors de la création du devis:', error);
        } finally {
          this.loading = false;
        }
      }
    },
    resetForm() {
      this.form = {
        matricule: "",
        puissanceFiscale: "",
        dateMiseEnCirculation: "",
        valeurNeuve: "",
        valeurVenale: "",
        marque_id: "",
        modele_id: "",
        type_motorisation_id: "",
      };
      this.formCl = {
        nom: "",
        prenom: "",
        email: "",
        telephone: "",
        ville_id: "",
        date_naissance: "",
        password: '',
        confirmPassword: ''
      };
      this.errors = {};
      this.errorsCl = {};
      this.selectedGaranties = [];
      this.selectedOptions = {};
    },
  },
};
</script>
