<template>
  <nav class="navbar navbar-light" style="background-color: #f6f9fc;">
   
      <ul class="md:flex md:items-center"  >
      <li >
        <a> <img src="../assets/logo.png"  width="50px" height="50px" alt="logo"></a>
      </li>
      <li>
      <router-link id="link" class="link" to="/corporate"> Produits</router-link> </li>
      <li>
        <router-link id="link" class="link" to="/corporate"> En cas de sinistre</router-link>
      </li>
      <li>
        <router-link id="link" class="link" to="/corporate">Questions fréquentes</router-link>
      </li>

      </ul>
   <div class="right-liens">
    <div class="buttons"> 
         <button>
          <i>
            <img src="../assets/left.svg">
          </i>Site Particulier</button>
       </div>
<div class="buttons">

<button><i><img src="../assets/user.svg"></i>
  Espace Client</button>
</div>
</div>
</nav>
  </template>
  <style>
  
  #link:hover {
    color:RGB(32, 140, 217);
    text-decoration: none;
    background-color: inherit;
  }
.text-gray-100 {
color: black; 
align-items: center;
justify-content: center;
font-size: 16px;
font-family: 'Roboto', sans-serif;
}

.md\:flex {
display: flex;
}

.md\:mx-4 {
margin-right: 20px;
background-color: antiquewhite;


}
.link{
  display: flex;
  align-items: center;
  margin-right: 10px; 
  color: rgb(4, 0, 0);
  text-decoration: none;
  padding-top:15px;

}

ul >li{
  list-style-type: none;
}


.right-liens{
  display: flex;
  margin-left: auto;
  justify-content: space-between;
  padding-right: 2%;
  color: #000;
}
.buttons{
  display: flex;
  align-items: center;
  margin-right: 10px;
}
button i {
  margin-right: 10px; /* Ajoute de l'espace entre l'icône et le texte */
}
button {
  background-color: rgb(41, 140, 197); /* Couleur bleue pour le bouton */
  color: white; /* Texte blanc sur fond bleu */
  padding: 10px 10px; 
  border: none; /* Pas de bordure */
  cursor: pointer; /* Curseur de type pointer pour indiquer que le bouton est cliquable */
}
button img {
  width: 20px; /* Ajuster la taille de l'image */
  height: 20px;
  vertical-align: middle; /* Aligner l'image verticalement au centre */
}
nav ul li {
  padding-top:10px;
  display: inline-block;
  margin-right: 20px; 
}

</style>

  <script>
  export default {
    
  }
 </script>


