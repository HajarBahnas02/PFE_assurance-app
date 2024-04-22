
import { RouterLink } from 'vue-router';
/* 
<template>
    <div class="menue">
        <div class="paragraph">
          <span class="citation">
    <h1>Protégez ce qui compte le plus. Votre sécurité, notre priorité.
    </h1></span>
    <p>
        Avec notre simulateur d'assurance, obtenez votre devis et souscrivez à votre contrat d'assurance, en 
        moins de 5 minutes sans vous déplacer.
    </p>
    </div>
  <div class="container">
    <div class="box">
      <div class="ina">
      <img src="../assets/automobile-icon.svg" alt="Image 1">
    </div>
      <div class="cla">
      <h3>Assurance Auto</h3></div>
    </div>
    <div class="box">
      <div class="ina">
      <img src="../assets/home-icon.svg" alt="Image 1">
    </div>
      <div class="cla">
      <h3>Assurance Habitation</h3></div>
    </div>
     <!--<div   class="box">-->
      <routerLink to="/Auto.vue" class="box">
  <div class="ina">
    <img src="../assets/health-insurance.svg" alt="Image 1">
  </div>
  <div class="cla">
    <h3>Assurance santé Internationale</h3>
  </div>
</routerLink>
  <div class="box">
      <div class="ina">
      <img src="../assets/health-care.svg" alt="Image 1">
    </div>
      <div class="cla">
      <h3>Assurance santé individuelle</h3></div>
    </div>
    <div class="box">
      <div class="ina">
      <img src="../assets/prevoyance-icon.svg" alt="Image 1">
    </div>
      <div class="cla">
      <h3>Assurance Prévoyance</h3></div>
    </div>
  </div>
    <!-- Ajoutez autant de cartes que nécessaire -->
  </div>
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
  
</div>

</template>
<style >

.citation{
  font-family: 'Roboto', sans-serif;
    font-size: 30px;
    font-weight: bold;
    color: rgb(251 173 27); 
    text-align: center;
    margin-top: 10px; 
    margin-bottom: 10px; 
    position:relative;
}
.citation ::after{
  position: absolute;
  animation:typing 1.5s steps(40)infinite;
}
.paragraph{
    text-align: center;
    color: white;
    text-align: center;
    margin-bottom: 10px;
    margin-top: 1%;
}
.paragraph > h1{
  font-size: 30px;
    line-height: 48px;
    letter-spacing: 0px;
    margin-bottom: 5px;
    font-weight: 100 !important;
    font-family: Roboto
}
.paragraph> p{
  padding: 0px 20%;
  font-size: 20px;
    line-height: 30px;
    letter-spacing: 0px;
    margin-bottom: 10px;
    font-family: Roboto;
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    unicode-bidi: isolate;

}
.box{
		width: 200px;	
		transition: 1s;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #e9f1fa;
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
  background: linear-gradient(319.91deg, rgb(0, 25, 77) 0%, rgb(0, 117, 201) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
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
    background: #e9f1fa;
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
 color:rgb(251 173 27);
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

</style>