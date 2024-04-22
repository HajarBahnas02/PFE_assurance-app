<template>
  <header>
    <div class="left-div">
      <router-link to="/about"> Professionnel</router-link>

      <router-link class="second-link" to="/corporate"><a> Corporate</a></router-link>
    </div>

    <div class="center-div">
      <router-link to="/facebook">
        <img
          class="logo"
          src="../assets/facebook-icon.svg"
          width="50px"
          alt="Facebook logo"
        />
      </router-link>
      <routerLink to="/youtube">
        <img class="logo" src="../assets/yout-icon.svg" width="50px" alt="youtube logo" />
      </routerLink>

      <routerLink to="/youtube">
        <img
          class="logo"
          src="../assets/insta-icon.svg"
          width="50px"
          alt="youtube logo"
        />
      </routerLink>
    </div>
    <div class="right-div">
      <div class="item">
        <img src="../assets/location.svg" width="50px" class="logo" alt="Contact logo" />
        <a>Localisation</a>
      </div>
    </div>
    <div class="item">
      <img src="../assets/contact.svg" width="50px" class="logo" alt="Contact logo" />
      <a>Contact</a>
    </div>
  </header>
</template>
<style scoped>
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 60px;
}
.router-link {
  color: violet;
  text-decoration: none;
  font-size: 1.2em;
}
.left-div {
  margin-left: 20%;
}
.second-link {
  margin-left: 15px;
}

.center-div {
  /* Styles pour la div du centre */
  margin: 0 auto; /* Pour centrer horizontalement */
}

.right-div {
  display: flex;
  justify-content: center;
  margin-left: 20%;
}
.item {
  display: flex;
  align-items: center;
}
.item:not(:last-child) {
  margin-right: 30px;
}
.logo {
  padding-right: 12px;
}
.logo:last-child {
  margin-right: 0;
}
.item:not(:last-child) {
  margin-right: 20px; /* Ajouter un espace de 20px entre chaque paire de logo et titre */
}
</style>
