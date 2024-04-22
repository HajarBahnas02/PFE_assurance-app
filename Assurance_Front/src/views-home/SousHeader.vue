<template>
    <!--sous header style not yet !-->
    <div class="bg-gray-900 text-gray-100 py-3.5">
    <!-- <div class="flex">
        <span class="text">
          <i></i>
        </span>
      </div>-->
      <ul class="md:flex md:items-center">
      <li class="md:mx-4">
        <a> <img src="###" alt="logo"></a>
      </li>
        <li class="md:mx-4">
          <a :href="Links[0].link">{{ Links[0].name }}</a>
        </li>
        <li class="md:mx-4">
          <a :href="Links[1].link">{{ Links[1].name }}</a>
        </li>
        <li class="md:mx-4">
          <a :href="Links[2].link">{{ Links[2].name }}</a>
        </li>
      </ul>
   <div class="right-liens">
    <div class="buttons"> 
        <i>
          <img src="../assets/left.svg">
        </i>
         <button>Site Particulier</button>
       </div>
<div class="buttons">
<i><img src="../assets/user.svg"></i>
<button>Espace Client</button>
</div>
</div>
 </div>
  </template>
  <style>
a:hover {
background-color: #5d76b3; /* Adjust this value to set the hover background color */
color: #fff; /* Adjust this value to set the hover text color */
}
.bg-gray-900 {
  height: 40px;
background-color: #E9F1FA;
display: flex; 
justify-content:  center;
padding-left: 10%;
justify-content: center;
align-self: center;
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


