<template>
  <header>
    <div class="left-div">
      <router-link id="link" to="/about"> Professionnel</router-link>

      <router-link id="link" class="second-link" to="/corporate"><a> Corporate</a></router-link>
    </div>

    <div class="center-div">
      <router-link to="/facebook">
        <img
          class="logoCenter"
          src="../assets/facebook-icon.svg"
          width="50px"
          alt="Facebook logo"
        />
      </router-link>
      <routerLink to="/youtube">
        <img class="logoCenter" src="../assets/yout-icon.svg" width="50px" alt="youtube logo" />
      </routerLink>

      <routerLink to="/insta">
        <img
          class="logoCenter"
          src="../assets/insta-icon.svg"
          width="50px"
          alt="insta logoC"
        />
      </routerLink>
    </div>
    <div class="right-div">
      <div class="item">
        <img src="../assets/location.svg" width="50px"  height="40px" class="logon" alt="Contact logo" />
        <router-link id="link"  to="/corporate"><a> Localisation</a></router-link>
</div>
     
   
    <div class="item">
      <img src="../assets/location.svg" width="50px"  height="40px" class="logon" alt="Contact logo" />
      <router-link id="link" to="/corporate"><a> Contact</a></router-link>
    </div>  </div>
  </header>
</template>
<style scoped>
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 5%;
  background-color: #F7C566;
}
#link {
  color: #283B42;
  font-family: "pt-sans", sans-serif;
  font-weight: 700;
  background-color: none;
}
#link:hover {
  color: #7cb9cf;
  text-decoration: none;
}
.left-div {
  margin-left: 20%;
}
.second-link {
  margin-left: 15px;
}

.center-div {
  margin: 0 auto; /* Pour centrer horizontalement */
}

.right-div {
  display: flex;
  justify-content: center;
  margin-right: 1%;
 

}
.item {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.logo {
  padding-right: 15px;
  align-items: center;
}
.logoCenter {
  padding-right: 15px;
  align-items: center;
}

</style>
