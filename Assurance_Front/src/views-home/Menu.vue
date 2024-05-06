<template>
  <div class="menue">
    <div class="paragraph">
      <span class="citation" id="typewriter">
        <h1 :class="{ 'white-text': showWhiteText }">{{ animatedText }}</h1>
      </span>
    </div>
    <div clas="para">
      <p class="para-text">
         Avec notre simulateur accédez à votre devis personnalisé et souscrivez à votre assurance en seulement 5
        minutes
        <br />
        et sans aucun déplacement requis.
      </p>
    </div>

    <div class="container-devis">
      <div v-if="showCardList" class="overlay" @click="hideCards"></div>

      <div class="container-devis">
        <div class="box" @click="showCards">
          <img class="image-devis" src="../assets/automobile-icon.svg" alt="Image 1" />
          <h3 class="title-devis">Assurance Auto</h3>
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
  <!-- Ajoutez autant de cartes que nécessaire -->

  <div class="frame">
    <div class="infos">
      <h3 class="formule">Prêts à souscrire en ligne à nos assurances ?</h3>
      <p class="assura">
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
          src="../assets/simulation-icon.svg"
          alt="img simulation icon"
        />
        <h3 class="card-title">Faites vous livrer votre attestation</h3>
        <p class="card-description">
          Une fois le paiement effectué, vous êtes assurés, recevez instantanément une
          copie de votre attestation d'assurance , qui vous sera également livrée à
          l'adresse que vous aurez indiquée
        </p>
      </div>
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
        <img class="card-img" src="../assets/payment-icon.svg" alt="Image 1" />
        <h3 class="card-title">Souscrivez en ligne ou en agence</h3>
        <p class="card-description">
          Validez votre devis et réglez votre souscription en optant pour un paiement en
          ligne totalement sécurisé ou par chèque à la livraison de votre contrat ou opter
          pour une souscription en agence>
        </p>
      </div>
    </div>
    <div class="underPage">
      <div class="imgAss">
        <img src="../assets/acceuil.jpg" />
      </div>
      <div class="conditions">
        <h1 class="titleAvantage">
          Découvrez les Avantages Exclusifs de Notre Agence d'Assurance
        </h1>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">La soumission en ligne à la gestion de compte 24/7,</p>
        </div>
        <div class="condition">
          <img class="verification-img" src="../assets/circle-check.svg" alt="" />
          <p class="paragAvan">
            gamme complète de produits pour répondre à tous vos besoins.
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
.carde img {
  padding-top: 32px;
  max-width: 100%; 
  max-height: 100%; 
}

.carde h3 {
  font-size: 17px;
  font-weight: bold;
  color: #000000;

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
.cards-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 0px;
  margin: 0px;
}
.card {
  border: 1px solid #ccc;

  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  background-color: #052659;
  margin: 5px;
  padding: 0px;
  width: 250px;
  min-width: 250px;
}

.card-img {
  height: 84px;
  width: 84px;
  /* Pour centrer l'image horizontalement */
}

.card-title {
  font-size: 15px;
  color: white;
  margin-top: 10px;
  margin-bottom: 5px;
}

.card-description {
  color: #280019;
  font-size: 14px;
  text-align: left;
  margin: 0px;
  display: block;
  margin-block-start: 1em;
  margin-block-end: 1em;
  margin-inline-start: 0px;
  margin-inline-end: 0px;
  unicode-bidi: isolate;
}

/* Pour rendre les cartes responsives */
@media screen and (max-width: 600px) {
  .card {
    width: 70%;
    margin: 10px auto;
  }
}
.underPage {
  display: flex;
  width: 100%;
}
.imgAss {
  width: 50%;
  padding-left: 1%;
  margin-right: 2%;
}

.hajar {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
}

.bouchra {
  font-weight: bold;
  margin-bottom: 10px;
}

.anas {
  text-align: justify;
}
* {
  margin: 0px;
  padding: 0px;
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
  margin-top: 10px;
  margin-bottom: 10px;
}
.paragraph {
  margin-left: 13%;
  margin-right: 13%;
}
.para-text {
  font-family: "Arial", sans-serif; /* Police de caractères */
  font-size: 20px; /* Taille de la police */
  line-height: 1.5; /* Hauteur de ligne pour une meilleure lisibilité */
  color: white; /* Couleur du texte */
  text-align: center;
  font-weight: bold;
}
.para {
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

.titleAvantage {
  color: #1C1DAB;
  font-size: 23px;
  font-weight: bold;
  font-style: oblique;
  text-decoration: none !important;
  padding-top: 4%;
}
.conditions {
  display: flex;
  flex-direction: column;
  width: 50%;
}
.verification-img {
  height: 30px;
  width: 30px;
  margin-right: 10px;
  margin-left: 10px;

  margin-bottom: 10px;
}
.condition {
  display: flex;
  justify-content: center;
  margin: 10px;
  padding: 10px;
  justify-content: start;
}
.paragAvan {
  color: rgb(13, 13, 13);
  padding: 0px 30px 10px;
  text-align: left;
  margin: 0px;
  font-size: 20px;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
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

.frame h3 {
  display: flex;
  padding-left: 20%;
}

.formule {
  font-family: "Montserrat", sans-serif;
  font-size: 28px;
  font-weight: bold;
  color: #283b42;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}

.frame {
  display: block;
  padding-top: 1%;
  background-color: #f6f9fc;
}
.frame p {
  justify-content: center;
  display: flex;
  align-items: center;
  unicode-bidi: isolate;
  margin-right: 10px !important;
  margin-left: 10px !important;
  text-align: center;
}
.infos {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 0px;
  margin: 0px;
  width: 100%;
  padding-left: 10%;
  padding-right: 12%;
}
.assura {
  display: flex;
  color: black;
  font-weight: bold;
  text-align: center;
}
</style>

<script>
export default {
  data() {
    return {
      showCardList: false ,// Pour contrôler l'affichage de la liste des cartes
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
}
  },
};
</script>
<style scoped>
h1 {
  margin: 0 auto;
  text-decoration: none; 
  font-weight: bold;
  font-family: "Arial", sans-serif;
  color: #1d2a5c;
  font-size: 50px;
}

/* Style pour le texte en blanc */
.white-text {
  font-family: "Arial", sans-serif;
    color:RGB(54, 27, 38);
  font-size: 45px;
  display: inline-block;
  padding-bottom: 10px;
}
</style>
