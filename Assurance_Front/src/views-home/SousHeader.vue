<template>
  <nav class="navbar navbar-light" style="background-color: #D1E8FF;">
   
      <ul class="md:flex md:items-center" >
      <li >
        <a> <img src="###" alt="logo"></a>
      </li>
      <li>
      <router-link id="link" class="link" to="/corporate"> Produits</router-link> </li>
      <li>
        <router-link id="link" class="link" to="/corporate"> En cas de sinistre</router-link>
      </li>
      <li>
        <router-link id="link" class="link" to="/corporate">Question fréquentes</router-link>
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
  
a:hover {
background-color: #D1E8FF; /* Adjust this value to set the hover background color */
color: #fff; /* Adjust this value to set the hover text color */
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
  color: black;
  text-decoration: none;

}
ul >li{
  list-style-type: none;}

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
  background-color: rgb(73, 73, 214); /* Couleur bleue pour le bouton */
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
  padding-top:15px;
  display: inline-block;
  margin-right: 20px; /* Ajoute un espace entre les liens */
}

</style>

  <script>
  export default {
    setup() {
      let Links = [
      
        { name: "Produits", link: "/produits" },
        { name: "En cas de sinistre", link: "https://www.google.ma" },
        { name: "Questions fréquentes", link: "https://www.google.ma" }
      ];
      return { Links };
    }
  }
 </script>


