
import { RouterLink } from 'vue-router';
/* 
<template>
    <div class="menue">
        <div class="paragraph">
          <span class="citation" id="typewriter">
<!--         <h1>{{ animatedText }}</h1>-->   
<h1 :class="{ 'white-text': showWhiteText }">{{ animatedText }}</h1>
  </span>
        </div>
  <div clas="para">
    <p  class="para-text">
      Accédez à votre devis personnalisé et souscrivez à votre assurance en seulement 5 minutes
      <br> et sans aucun déplacement requis.</p></div>
  
  <div class="container">
    <div class="box">
      <routerLink to="/automobile-icon.vue" class="box">
  <div class="ina">
    <img src="../assets/automobile-icon.svg" alt="Image 1">
  </div> 
  <div class="cla">
    <h3>Assurance Auto</h3>
  </div></routerLink></div>
 
    <div class="box">
      <routerLink to="/AssHabitation.vue" class="box">
  <div class="ina">
    <img src="../assets/home-icon.svg" alt="Image 1">
  </div> 
  <div class="cla">
    <h3>Assurance Habitation</h3>
  </div></routerLink></div>
    <div class="box">
      <routerLink to="/AssSanteInter.vue" class="box">
  <div class="ina">
    <img src="../assets/health-insurance.svg" alt="Image 1">
  </div> 
  
  <div class="cla">
    <h3>Assurance santé Internationale</h3>
  </div></routerLink></div>

  <div class="box">
    <routerLink to="/AssSanteInter.vue" class="box">
<div class="ina">
  <img src="../assets/health-care.svg" alt="Image 1">
</div> 
<div class="cla">
  <h3>Assurance santé individuelle</h3>
</div></routerLink></div>
<div class="box">
  <routerLink to="/AssSanteInter.vue" class="box">
<div class="ina">
<img src="../assets/prevoyance-icon.svg" alt="Image 1">
</div> 
<div class="cla">
<h3>Assurance Prévoyance</h3>
</div></routerLink></div>
  
    
  </div>
</div>
    <!-- Ajoutez autant de cartes que nécessaire -->
 
<div class="frame">
  <h3 class="formule">
    Prêts à souscrire en ligne à nos assurances ?  </h3>
  <p class="assura">
Simple et rapide, l'assurance en ligne Sanlam vous permet d'être couvert en quelques clics. Aucun
 déplacement n'est nécessaire, tout se fait à distance !
  </p>
  
    <div class="container">
    <div class="card">
      <div class="ina">
      <img src="../assets/simulation-icon.svg" alt="Image 1">
    </div>
      <div>
        <h3 class="cla">Réalisez votre simulation</h3>
     
        <p >Complétez notre formulaire de simulation d'assurance en ligne et choisissez les garanties qui répondent le mieux à 
        vos besoins, pour obtenir votre tarif en moins de 2 minutes</p>
    </div>
    </div>
    <div class="card">
      <div class="ina">
        <img src="../assets/payment-icon.svg" alt="Image 1">
    </div>
      <div>
        <h3 class="cla">Souscrivez en ligne ou en agence</h3>
      <p>Validez votre devis et réglez votre souscription en optant pour un paiement en ligne totalement sécurisé ou par chèque à la livraison de votre 
        contrat ou opter pour une souscription en agence </p></div>
    </div>
    <div class="card">
      <div class="ina">
      <img src="../assets/insure-certificate-icon.svg" alt="Image 1">
    </div>
      <div>
        <h3 class="cla">Faites vous livrer votre attestation</h3>
      <p>Une fois le paiement effectué, vous êtes assurés, recevez instantanément une copie de votre attestation d'assurance, qui vous sera 
        également livrée à l'adresse que vous aurez indiquée</p>    </div>
    </div>
    <div class="card">
      <div class="ina">
      <img src="../assets/delivery-icon.svg" alt="Image 1">
    </div>
      <div>
        <h3 class="cla">Accédez à votre espace client</h3>
        
      <p>Inscrivez-vous sur l'espace client Sanlam pour accéder
         à de nombreux services et consulter tous les détails de votre contrat.</p>
    </div>
    </div>
  
  
  
  </div>
  <div class="imf">
    <div class="imageA">
      <img src="../assets/acceuil.jpg">
    </div>
  <div class="conditions">
    <div class="condition"> 
      <img src="../assets/circle-check.svg" alt="">
      <p> Offre de services complémentaires</p>
    </div>
    <div class="condition"> 
      <img src="../assets/circle-check.svg" alt="">
      <p> Offre de services complémentaires</p>
    </div>

  </div>
  </div>
</div>

</template>

<style >
.imf{
  display: flex;
  margin-top: 10px;
}
.conditions{
  display: flex;
  justify-content: center;
  align-items: columns;
  ;
}
.hajar {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
}

.bouchra{
  font-weight: bold;
  margin-bottom: 10px;
}

.card-image {
  display: block;
  width: 100%;
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
  border-right: .15em solid rgb(228, 216, 194); /* Curseur clignotant */
  white-space: nowrap; /* Empêcher le saut de ligne */
  margin: 0 auto; /* Pour centrer le texte */
  animation: typeWriter 2s steps(20, end); /* Animation du type d'écriture */
}
@keyframes typeWriter {
  from { width: 0 }
  to { width: 100% }
}
.citation{
  font-family: 'Roboto', sans-serif;
    font-size: 30px;
    font-weight: bold;
    color: #85B8CB; 
    text-align: center;
    margin-top: 10px; 
    margin-bottom: 10px;
}
.paragraph{
  margin-left: 13%;
  margin-right: 13%;
}
.para-text  {
  font-family: 'Arial', sans-serif; /* Police de caractères */
  font-size: 20px; /* Taille de la police */
  line-height: 1.5; /* Hauteur de ligne pour une meilleure lisibilité */
  color:#DC6B19; /* Couleur du texte */
  text-align: center; 
}
.para{
  max-width: 800px; /* Pour limiter la largeur du texte */
  margin: 0 auto; /* Pour centrer le texte horizontalement */
  display: flex; /* Utiliser flexbox pour le centrage vertical */
  justify-content: center; /* Alignement horizontal au centre */
  align-items: center; 
}

.box{
		width: 200px;	
		transition: 1s;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #FFF8DC;
    box-shadow: 0 1px 1px 0 rgba(0,0,0,0.03), 0 0 24px 0 rgba(0,0,0,0.08);
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
	}
  
	.box:hover{
		transform: scale(1.3);
		z-index: 2;
	}
.cla{
  color: black;
    font-size: 20px;
    margin: 0px;
    font-weight: bold;
    margin-top: 12%;
    
}
.cla >h3{
  text-decoration: none;
}

.parg {
    color: rgb(227, 230, 235);
    padding: 0px 30px 10px;
    text-align: left;
    margin: 0px;    
}

.ina{
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
.menue{
  background: linear-gradient(319.91deg, #6C0345 0%,#1D6A96 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 2%;
}
.menue > h1{
    font-size: 30px;
    line-height: 48px;
    letter-spacing: 0px;
    margin-bottom: 5px;
    font-weight: 100 !important;
    color: rgb(4, 2, 2) !important;
}

.container {
  width: 100%;
    display: flex;
    box-sizing: border-box;
    width: 100%;
	  margin-bottom: 2%;	 
		display: flex;
		flex-direction: row;
		justify-content: center;
  }
  .card{
    background: #85B8CB;
    height: 400px;
    width: 100%;
    margin: 10px;
    padding: 10px;
    min-width: 250px;
  }
  .card p{
    padding-left: 1%;
  }
 
.box img {
  width: 100%; 
  align-items: center;
  display: block;
}


.box h2 {
  margin-top: 5px;
}
.frame h3 {
 display: flex;
padding-left: 20%;
}

  .formule  {
 font-family: 'Montserrat', sans-serif; 
 font-size: 28px;
 font-weight: bold; 
 color:#283B42;
 text-align: center; 
 margin-top: 10px;
 margin-bottom: 10px; 
}


.frame  {
 display: block;
 margin-bottom: 5px;
padding-left: 20%;
padding-top: 1%;
padding-right: 20%;
background-color: #D1DDDB;
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
.assura{
  color: black;
  font-weight: bold;
}
p{
  color: #D1DDDB;
  font-weight: bold;
  font-size: 20px;
  padding-left: -10px;


}

</style>

<script>export default {
  data() {
    return {
      text: "Protégez ce qui compte le plus. Votre sécurité notre priorité",
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
    }
  },
};
</script>
<style scoped>
h1 {
  overflow: hidden; /* Pour cacher le texte restant */
  border-right: .15em solid rgb(210, 206, 200); /* Curseur clignotant */
  white-space: nowrap; /* Empêcher le saut de ligne */
  margin: 0 auto; /* Pour centrer le texte */
}

/* Style pour le texte en blanc */
.white-text {
  color: #54cdb9;
}
</style>
