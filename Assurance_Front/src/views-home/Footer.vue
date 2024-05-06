<template>
  <footer>
    <div class="footerContainer">
      <div class="footerNav" style="color: white">
        <p>Copyright &copy;2024 | Tous droits reservés          <span class="designer"></span></p>
      </div>

      <div class="footerNav">
        <ul>
          <li><a href="">Mentions légales</a></li>
          <li><a href="">CGU</a></li>
          <li><a href="">Lexique</a></li>
          <li><a href="">FAQ</a></li>
          <li><a href="">Contactez-nous</a></li>
        </ul>
      </div>
      <div class="socialIcons">
        <a href=""><i class="fa-brands fa-facebook"></i></a>
        <a href=""><i class="fa-brands fa-instagram"></i></a>
        <a href=""><i class="fa-brands fa-twitter"></i></a>
        <a href=""><i class="fa-brands fa-google-plus"></i></a>
        <a href=""><i class="fa-brands fa-youtube"></i></a>
      </div>
      <div id="app">
        <router-view />
      </div>
    </div>
  </footer>
</template>
<style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
footer {
    background-color: #035fa9;
}
.footerContainer {
  width: 100%;
  padding: 20px 20px 0px;
  display: flex;
}
.socialIcons {
  display: flex;
  justify-content: center;
}
.socialIcons a {
  text-decoration: none;
  padding: 10px;
  background-color: white;
  margin: 10px;
  border-radius: 50%;
}
.socialIcons a i {
  font-size: 2em;
  color: black;
  opacity: 0, 9;
}
/* Hover affect on social media icon */
.socialIcons a:hover {
  background-color: #111;
  transition: 0.5s;
}
.socialIcons a:hover i {
  color: white;
  transition: 0.5s;
}
.footerNav {
  margin: 0 0;
}
.footerNav ul {
  display: flex;
  justify-content: center;
  list-style-type: none;
}
.footerNav ul li a {
  color: white;
  margin: 20px;
  text-decoration: none;
  font-size: 1.3em;
  opacity: 0.7;
  transition: 0.5s;
}
.footerNav ul li a:hover {
  opacity: 1;
}
.footerBottom {
  background-color: #000;
  padding: 10px;
  text-align: center;
}
.footerBottom p {
  color: white;
}
.designer {
  opacity: 0.7;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 100;
  margin: 0px 5px;
}
@media (max-width: 400px) {
  .footerNav ul {
    flex-direction: column;
  }
  .footerNav ul li {
    width: 100%;
    text-align: center;
    margin: 10px;
  }
  .socialIcons a {
    padding: 8px;
    margin: 4px;
  }
}
</style>
