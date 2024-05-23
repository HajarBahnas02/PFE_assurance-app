<template>
    <layout />
    <div class="processing-page">
      <div class="message">
      <p>Votre devis est en cours de traitement.Vous recevez une notification dans quelques minutes par whatssap et par email avec la tarification
         afin de continuer votre souscription en ligne.
               <br/> <b> Merci pour  choix  de Shahed assurance</b></p>
        <img src="../assets/message.png" id="thank-you" width="13%"/>
<div>        <router-link to="/" class="home-button">
    <i class="fa fa-home"></i>
    Retour à l'accueil</router-link></div>

      </div>
     
    </div>
    <Footer />
  </template>
  
  <style> .processing-page {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgb(26, 216, 9);
  }
  #thank-you {
    font-size: 36px; /* Taille de police plus grande */
    font-family: 'Arial', sans-serif; /* Police de caractères claire et stylée de votre choix */
    font-weight: bold; /* Texte en gras */
    color: #165e85; /* Couleur de texte */
  }
  
  .message {
    text-align: center;
    color: black;
    font-size: 23px; 
    font-weight: 600;
    line-height: 1.5;
    font-family: 'Roboto', sans-serif; /* Police de caractères audacieuse */
    font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    margin: 2%;
  }
  
  .home-button {
    display: inline-block;
    margin-TOP: 3%;
    padding: 10px 20px;
    background-color: blue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  b{
    text-align: center;
    color: black;
    font-size: 23px; 
    font-weight: 800;
    line-height: 1.5;
    font-family: 'Brush Script MT', cursive; /* Utilisation de la police Brush Script MT */
  font-size: 36px; /* Taille de police plus grande */
  font-weight: bold; 
  color: #165e85;
  }
  .home-button:hover {
    background-color: green;
  }
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  .processing-page {
    background: linear-gradient(to bottom, #ffffff, #f0f0f0); /* Dégradé léger */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  .message {
    text-align: center;
  }
  
  #thank-you {
    font-family: 'Roboto', sans-serif; /* Police de caractères audacieuse */
    font-size: 24px;
    color: #165e85;
    background-color: aliceblue; /* Couleur de texte */
  }
  
  .home-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: blue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  
  .home-button:hover {
    background-color: green;
  }
  .message {
    animation: fadeIn 1s ease;
  }
    </style>
    <script>// Importez anime.js si vous l'avez installé via npm
import anime from 'animejs';
import Footer from '../views-home/Footer.vue';
import Layout from '../views-home/Layout.vue';
export default {
    components: {
        Footer,
        Layout
    },
  mounted() {
    const thankYou = document.getElementById('thank-you');
    const message = document.querySelector('.message');
    animateFloating(thankYou);

    // Animez l'élément
    anime({
      targets: message,
      translateY: [-150, 0], // Déplacez l'élément de -50px à 0px en Y
      opacity: [0, 1], // Changez l'opacité de 0 à 1
      duration: 1000, // Durée de l'animation en millisecondes
      easing: 'easeOutQuad' // Fonction d'accélération
    });
    function animateFloating(element) {
  // Animez l'élément en le déplaçant de haut en bas de façon répétitive
  let translateY = 0;
  setInterval(() => {
    translateY = translateY === 10 ? -10 : 10; // Changez la direction de l'animation
    element.style.transform = `translateY(${translateY}px)`;
  }, 1000); // Changez la durée ou la vitesse de l'animation selon vos préférences
}
  }
}
</script>
    