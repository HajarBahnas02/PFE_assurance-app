<template>
  <div class="background">
    <div class="image"></div>
    <div class="color"></div>
    <div class="content">
      <div class="form-container">
        <!--
        <ul>
          <label>typeMotorisations</label>
          <li v-for="typePoste in typeMotorisations" :key="typePoste.id">
            {{ typePoste.typeM }}
          </li>
        </ul>-->
        <label for="marque">Marque :</label>
        <select v-model="selectedMarque" class="form-control" id="marque">
          <option value="" disabled selected>Choisissez une marque</option>
          <option v-for="marque in marques" :key="marque.id" :value="marque.nomMarque">
            {{ marque.nomMarque }}
          </option>
        </select>
      </div>
      <div class="contact-info">
        <h5>Besoin d'aide ?</h5>
        <p>Contactez nous du lundi au vendredi de 9h à 18h</p>
        <button><img src="" alt="Icone appel" />0650343434</button>
        <button><img src="" alt="Icone appel" />0650343434</button>
      </div>
      <div></div>
    </div>
  </div>
</template>
<style>
scooped body,
html {
  margin: 0;
  padding: 0;
  height: 100%;
  font-family: Arial, sans-serif; /* Choisir une police de caractères si nécessaire */
}

.background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%; /* Divise la page en deux */
  background-image: url("..\assets\acceuil.jpg"); /* Remplace "lien_vers_ta_photo.jpg" par le chemin de ta photo */
  background-size: cover;
  background-size: 100% 100%;
  background-repeat: no-repeat;
}
.color {
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  height: 50%;
  background-color: #dddddd;
}
.content {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: space-between; 
}

.form-container {
  margin-top: 10%;
  width: 80%;
  margin-right: 3%;
  margin-left: 3%;
  background-color: wheat;
  padding: 20px;
}

.contact-info {
  width: 18%;
  padding: 20px;
  margin-top: 10%;
  margin-right: 2%;
  background-color: blanchedalmond;
}
</style>

<script>
import axios from "axios";
/**
export default {
  data() {
    return {
      typeMotorisations: [],
    };
  },
  mounted() {
    this.fetchTypesPostes();
  },
  methods: {
    fetchTypesPostes() {
      axios
        .get(
          "/type-motorisation",

          {
            headers: {
              "Content-Type": "application/javascript",
            },
          }
        )
        .then((response) => {
          this.typeMotorisations = response.data;
          console.log("Types de motorisation : ", response);
        })
        .catch((error) => {
          console.error("Une erreur est survenue : ", error);
        });
    },
  },
};
*/
export default {
  data() {
    return {
      marques: [],
      selectedMarque: "",
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/Marques"),
      {
            headers: {
              "Content-Type": "application/javascript",
            },
          }
      .then((response) => {
        this.marques = response.data;
        console.log(response.data); // Vérifie que les données sont correctement récupérées
      })
      .catch((error) => {
          console.error("Une erreur est survenue : ", error);
        });
  },
};
console.log("marques", marques);
</script>
