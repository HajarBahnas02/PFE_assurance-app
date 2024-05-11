<template>
    <nav class="navbar">
      <div class="links" style="margin-left:3%">
        <a href="#">Professionnel</a>
        <a href="#">Corporate</a>
      </div>

      <ul class="links">
        <router-link to="/facebook">
          <img class="logo" style="margin-top:8px" src="../assets/facebook-icon.svg" alt="Facebook logo" />
        </router-link>
        <router-link to="/youtube">
          <img class="logo"  style="margin-top:8px" src="../assets/yout-icon.svg" alt="Youtube logo" />
        </router-link>
        <router-link to="/insta">
          <img class="logo" style="margin-top:8px" src="../assets/insta-icon.svg" alt="Instagram logo" />
        </router-link>
      </ul>
      <div class="buttons">
       <router-link class="link" to="/location"> <img src="../assets/location.svg" class="logo" style="margin-right:3px" alt="Location logo" />
        Localisation</router-link>
     
        
        <router-link class="link" to="/contact">
          <img src="../assets/contact.svg" class="logo"  style="margin-right:8px" alt="Location logo" />
          Contact</router-link>
          <router-link class="link" to="/adminPanel">
            <img src="../assets/admin.svg" class="logo"  style="margin-right:8px" alt="Location logo" />
            Admin</router-link>
          </div>
    </nav>
</template>

<style scoped>
.navbar{
  background-color: rgb(187 225 250);
  display: flex;
  align-items: center;
  flex-direction:row;
  justify-content: space-between;
  margin: 0 auto;
  padding: 0 15px;
}
.navbar .logo a {
  font-size: 1.8rem;
  text-decoration: none;
  color: black;
}
.navbar .links {
  display: flex;
  align-items: center;
  list-style: none;
  gap: 25px;
}


.logo {
  width: 40px;
  height: 40px;
  margin-right: 8px;
}

.navbar .links a {
  font-weight: 500;
  text-decoration: none;
  color: black;
  transition: 0.2s ease;
}

.navbar .links a:hover {
  color: #47b2e4;
}
.navbar .buttons a {
  text-decoration: none;
  color: black;
  font-size: 1rem;
  padding: 10px 0;
  transition: 0.2s ease;
}
.navbar .buttons a:hover {

   color: #47b2e4;
}
.navbar .buttons a:not(:last-child) {
  margin-right: 30px;
}



</style>