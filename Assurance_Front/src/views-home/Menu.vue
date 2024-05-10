<template>
  <div class="menue">
    <div class="paragraph">
      <span class="citation" id="typewriter">
        <h1 :class="{ 'white-text': showWhiteText }">{{ animatedText }}</h1>
      </span>
    </div>
    <div clas="sous-titre">
      <p class="soustitre-text">
        Avec notre simulateur accédez à votre devis personnalisé et souscrivez à votre
        assurance en seulement 5 minutes
        <br />
        et sans aucun déplacement requis.
      </p>
    </div>

    <div class="container-devis">
      <div v-if="showCardList" class="overlay" @click="hideCards"></div>

      <div class="container-devis">
        <div class="box" @click="showCards">
          <router-link to="/" class="box">
            <img class="image-devis" src="../assets/automobile-icon.svg" alt="Image 1" />
            <h3 class="title-devis">Assurance Auto</h3>
          </router-link>
        </div>
        <div v-if="showCardList" class="card-list">
          <!-- Cartes ici -->
          <div class="carde">
            <img src="../assets/auto-insure.svg" alt="Image de la carte 1" />
            <h3>Effectuer une simulation et souscrire un nouveau contrat​</h3>
            <button @click="goToPage('/assuranceAutoSimulation')">Accéder</button>
          </div>
          <div class="carde">
            <img src="../assets/auto-insure.svg" alt="Image de la carte 2" />
            <h3>Renouveler mon contrat Automobile​</h3>
            <button @click="goToPage('/page2')">Accéder</button>
          </div>
          <div class="carde">
            <img src="../assets/auto-insure.svg" alt="Image de la carte 2" />
            <h3>Demander votre carte verte en ligne</h3>
            <button @click="goToPage('/page2')">Accéder</button>
          </div>
        </div>
      </div>

      <div class="box" @click="showCards">
        <routerLink to="/AssHabitation.vue" class="box">
          <img class="image-devis" src="../assets/home-icon.svg" alt="Image 1" />
          <h3 class="title-devis">Assurance Habitation</h3>
        </routerLink>
      </div>

      <div class="box" @click="showCards">
        <routerLink to="/AssSanteInter.vue" class="box">
          <img class="image-devis" src="../assets/health-insurance.svg" alt="Image 1" />
          <h3 class="title-devis">Assurance Santé Internationale</h3>
        </routerLink>
      </div>

      <div class="box" @click="showCards">
        <routerLink to="/AssSanteInter.vue" class="box">
          <img class="image-devis" src="../assets/health-care.svg" alt="Image 1" />

          <h3 class="title-devis">Assurance Santé Individuelle</h3>
        </routerLink>
      </div>
      <div class="box" @click="showCards">
        <routerLink to="/AssSanteInter.vue" class="box">
          <img class="image-devis" src="../assets/prevoyance-icon.svg" alt="Image 1" />
          <h3 class="title-devis">Assurance Prévoyance</h3>
        </routerLink>
      </div>
    </div>
  </div>
  <div class="frame">
    <div class="infos">
      <h3 class="formule">Prêts à souscrire en ligne à nos assurances ?</h3>
      <p>
        Simple et rapide, notre assurance vous permet d'être couvert en quelques clics.
        Aucun déplacement n'est nécessaire, tout se fait à distance !
      </p>
    </div>
    <div class="cards-container">
      <div class="card">
        <img
          class="card-img"
          src="../assets/simulation-icon.svg"
          alt="img simulation icon"
        />
        <h3 class="card-title">Réalisez votre simulation</h3>
        <p class="card-description">
          Complétez notre formulaire de simulation d'assurance en ligne et choisissez les
          garanties qui répondent le mieux à vos besoins, pour obtenir votre tarif en
          moins de 2 minutes
        </p>
      </div>
      <div class="card">
        <img
          class="card-img"
          src="../assets/payment-icon.svg"
          alt="img simulation icon"
        />
        <h3 class="card-title">Souscrivez en ligne ou en agence</h3>
        <p class="card-description">
          Validez votre devis et réglez votre souscription en optant pour un paiement en
          ligne totalement sécurisé ou par chèque à la livraison de votre contrat ou opter
          pour une souscription en agence
        </p>
      </div>
      <div class="card">
        <img class="card-img" src="../assets/trois.svg" alt="img simulation icon" />
        <h3 class="card-title">Recevez votre attestation</h3>
        <p class="card-description">
          Une fois le paiement effectué, vous êtes assurés, recevez instantanément une
          copie de votre attestation d'assurance, qui vous sera également livrée à
          l'adresse que vous aurez indiquée
        </p>
      </div>

      <div class="card">
        <img class="card-img" src="../assets/quatre.svg" alt="Image 1" />
        <h3 class="card-title">Accédez à votre espace client</h3>
        <p class="card-description">
          Inscrivez-vous sur l'espace client Sanlam pour accéder à de nombreux services et
          consulter tous les détails de votre contrat.
        </p>
      </div>
    </div>
    <div class="underPage">
      <div class="imgAss">
        <img src="../assets/acceuil.jpg" />
      </div>
      <div class="conditions">
        <h2>
          Découvrez les Avantages Exclusifs de Notre Agence d'Assurance
          <span style="color: #026eb6">Shahed</span>:
        </h2>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">La soumission en ligne à la gestion de compte 24/7,</p>
        </div>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">
            Gamme complète de produits pour répondre à tous vos besoins.
          </p>
        </div>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">Tarifs compétitifs et options de paiement flexibles</p>
        </div>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">Une large étendue de garantie</p>
        </div>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">
            La Livraison gratuite de votre attestation partout au Maroc
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.container .box .image {
  margin: 10px 0;
  height: 150px;
  width: 150px;
  background: #82a289;
  padding: 3px;
  border-radius: 50%;
}
.cards-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  justify-content: center;
}
.card {
  height: 7%;
  text-align: center;
  width: 20%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(255, 255, 255);
  margin: 1%;
}
.card .card-img {
  height: 150px;
  width: 150px;
  background: rgb(187 225 250);
  border-radius: 50%;
  margin-bottom: 8%;
  margin-top: 2%;
  border: 2px solid #0628d4;
}
.card-img img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.card-title {
  padding-bottom: 10px;
  font-size: 18px;
  font-weight: 600;
}
.card .card-description {
  margin-left: 10px;
  margin-right: 10px;
  padding-bottom: 8px;
  font-size: 16px;
  font-weight: 400;
}
.box .image img {
  height: 100%;
  width: 100%;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #fff;
}
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Couleur grise semi-transparente */
  z-index: 999; /* Assure que la superposition est au-dessus de tout autre contenu */
}

/* Ajoutez ce style pour empêcher les interactions avec les éléments sous-jacents */
.overlay.active {
  pointer-events: auto; /* L'utilisateur pourra interagir avec les éléments de la liste */
}

.card-list {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(246, 249, 252);
  z-index: 1000; /* Assure que la liste est au-dessus de la superposition */
  max-width: 70%;
  background: linear-gradient(rgb(41, 140, 197) 160px, white 0%) rgb(255, 255, 255);
}

.carde {
  height: 400px;
  text-align: center;
  width: max-content;
  display: flex;
  padding: 10px;
  flex-basis: 25%;
  box-shadow: rgba(0, 0, 0, 0.03) 0px 1px 1px 0px, rgba(0, 0, 0, 0.08) 0px 0px 24px 0px;
  margin-top: 10px;
  margin-bottom: 10px;
  border-radius: 20px;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  background-color: rgb(255, 255, 255);
  margin: 16px;
}

.carde button {
  background-color: rgb(41, 140, 197); /* Couleur de fond du bouton */
  color: #ffffff; /* Couleur du texte du bouton */
  border: none; /* Pas de bordure */
  padding: 10px 20px; /* Espacement intérieur du bouton */
  border-radius: 5px; /* Coins arrondis du bouton */
  cursor: pointer; /* Curseur pointer au survol */
  transition: background-color 0.3s ease; /* Animation de transition fluide */
}

.carde button:hover {
  background-color: #0056b3; /* Couleur de fond du bouton au survol */
}
.image-devis {
  justify-content: center;
  display: flex;
  align-items: center;
  unicode-bidi: isolate;
  cursor: pointer;
  height: 75px;
  margin-right: 10px !important;
  margin-top: 20px !important;
  margin-left: 10px !important;
  text-align: center;
}
.container-devis {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 2%;
  position: relative;
}
.title-devis {
  color: black;
  font-size: 20px;
  font-weight: bold;
  font-style: oblique;
  text-decoration: none !important;
  margin-top: 1em;
}
@media screen and (max-width: 600px) {
  .card {
    width: 70%;
    margin: 10px auto;
  }
}
.underPage {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}
.imgAss {
  width: 49%;
  height: 100%;
  flex: 1 49%;
  margin-left: 1%;
}

#typewriter {
  overflow: hidden; /* Pour cacher le texte restant */
  border-right: 0.15em solid rgb(228, 216, 194); /* Curseur clignotant */
  white-space: nowrap; /* Empêcher le saut de ligne */
  margin: 0 auto; /* Pour centrer le texte */
  animation: typeWriter 2s steps(20, end); /* Animation du type d'écriture */
}
@keyframes typeWriter {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}
.citation {
  font-family: "Roboto", sans-serif;
  font-size: 30px;
  font-weight: bold;
  color: #85b8cb;
  text-align: center;
  margin-top: 1%;
  margin-bottom: 1%;
}
.paragraph {
 display: flex;
 justify-content: center;
}
.soustitre-text {
  font-family: "Arial", sans-serif; /* Police de caractères */
  font-size: 2vh; /* Taille de la police */
  line-height: 1.5; /* Hauteur de ligne pour une meilleure lisibilité */
  color: white; /* Couleur du texte */
  text-align: center;
  font-weight: bold;
}
.sous-titre {
  max-width: 800px; /* Pour limiter la largeur du texte */
  margin: 0 auto; /* Pour centrer le texte horizontalement */
  display: flex; /* Utiliser flexbox pour le centrage vertical */
  justify-content: center; /* Alignement horizontal au centre */
  align-items: center;
}

.box {
  transition: 1s;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
  box-shadow: 0 1px 1px 0 rgba(214, 18, 18, 0.03), 0 0 24px 0 rgba(0, 0, 0, 0.08);
  text-align: center;
  align-content: space-around;
  border-radius: 6px;
  justify-content: center;
  flex-grow: 0;
  max-width: 16.666667%;
  flex-basis: 16.666667%;
  min-width: 200px;
  height: 250px;
  margin: 10px;
  padding: 10px;
  text-decoration: none;
}

.box:hover {
  transform: scale(1.2);
  z-index: 2;
  background-color: rgb(187 225 250);
  text-decoration: none;
}

.verification-img {
  height: 30px;
  width: 30px;
  margin-left: 10px;
}
.condition {
  display: flex;
  justify-content: center;
  margin-left: 1%;
  padding: 1%;
  flex: 1 1 50%; /* La moitié de la largeur de l'écran sur les écrans larges */
  justify-content: start;
}
.conditions h2 {
  color: rgb(41 140 197);
  font-weight: bold;
  line-height: 1.2;
  font-size: 25px;
  margin-left: 9%;
  margin-right: 8%;
  margin-top: 5%;
}
.conditions {
  flex: 1 50%; /* La moitié de la largeur de l'écran sur les écrans larges */
  max-width: 50%;
}
.paragAvan {
  color: rgb(13, 13, 13);
  padding: 0px 4% 10px;
  text-align: left;
  font-size: 20px;
}

.menue {
  background-image: url("../assets/slider2x.png");
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 2%;
}
.menue > h1 {
  font-size: 30px;
  line-height: 48px;
  letter-spacing: 0px;
  margin-bottom: 5px;
  font-weight: 100 !important;
  color: rgb(4, 2, 2) !important;
}

.formule {
  display: flex;
  justify-content: center;
  font-family: "Montserrat", sans-serif;
  font-size: 28px;
  font-weight: bold;
  color: #283b42;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}
.formule p{
  font-family: "Montserrat", sans-serif;
  font-size: 28px;
  font-weight: bold;
  color: #324228;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}
.frame {
  display: block;
  padding-top: 2%;
  padding-bottom: 2%;
  background-color: #f6f9fc;
}

.infos {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0px;
  margin: 0px;
  width: 100%;
}
.infos p{
  margin-left: 11%;
  
}
</style>

<script>
export default {
  data() {
    return {
      showCardList: false, // Pour contrôler l'affichage de la liste des cartes
      text: "Protégez ce qui compte le plus, votre sécurité notre priorité",
      animatedText: "",
      index: 0,
      showWhiteText: false,
    };
  },
  mounted() {
    // Démarrez l'animation une fois que le composant est monté
    this.typeWriter();
  },
  methods: {
    typeWriter() {
      const interval = setInterval(() => {
        // Ajouter un caractère à la fois
        this.animatedText += this.text[this.index];
        this.index++;

        // Si nous avons atteint la fin du texte, arrêtez l'animation
        if (this.index === this.text.length) {
          clearInterval(interval);
          // Commencez à écrire en blanc
          this.startWhiteText();
        }
      }, 100); // Délai entre chaque caractère (en millisecondes)
    },
    startWhiteText() {
      setTimeout(() => {
        // Commencez à écrire en blanc
        this.showWhiteText = true;
      }, 1000); // Délai avant le changement de couleur (en millisecondes)
    },
    showCards() {
      this.showCardList = !this.showCardList; // Afficher ou masquer la liste des cartes lorsque l'utilisateur clique sur l'image
    },
    goToPage(route) {
      this.$router.push(route); // Naviguer vers la page spécifiée par la route
    },
    hideCards() {
      this.showCardList = false;
    },
  },
};
</script>
<style scoped>
h1 {
  margin: 0 auto;
  text-decoration: none;
  font-weight: bold;
  font-family: "Arial", sans-serif;
  color: white;
  font-size: 3vw;
}

/* Style pour le texte en blanc */
.white-text {
  font-family: "Arial", sans-serif;
  color: black;
  font-size: 3vw;
  display: inline-block;
  margin-left: 1%;
  margin-right: 1%;
  padding-bottom: 1%;
}
</style>
