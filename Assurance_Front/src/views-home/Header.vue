<template>
  <div class="header">
    <div class="left-div">
      <router-link id="link" to="/about"> Professionnel</router-link>

      <router-link id="link" class="second-link" to="/corporate"> Corporate</router-link>
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
        <router-link id="link"  to="/corporate"> Localisation</router-link>
</div>
     
   
    <div class="item">
      <img src="../assets/location.svg" width="50px"  height="40px" class="logon" alt="Contact logo" />
      <router-link id="link" to="/corporate"> Contact</router-link>
    </div>  </div>
    </div>
</template>
<style scoped>
.header {
  border-bottom: 2px solid black; 
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 5%;
  background-color:rgb(187 225 250);
  ;

}
#link {
  background-color: none;
  color: black;
  font-weight: 700;
  text-decoration: none;
}
#link:hover {
  color:RGB(32, 140, 217);
  text-decoration: none;
  background-color: inherit;
}
.left-div {
  margin-left: 20%;
}
.second-link {
  margin-left: 15px;
}

.center-div {
  display: flex;
}
.center-div img{
  margin-right: 13px; 
  width: 50px; 
  height: auto; 
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
