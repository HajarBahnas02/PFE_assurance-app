<template>
  <div class="footerContainer">
    <div class="footerNav">
      <p>Copyright &copy;2024 | Tous droits reservés <span class="designer"></span></p>
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

    <div class="footerNav icons">
      <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
      <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
      <a href="#" class="yt"><i class="fab fa-youtube"></i></a>
    </div>
  </div>
</template>

<style>
.footerContainer {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #035fa9;
}

.footerNav {
  margin: 10px 0;
  text-align: center;
}

.footerNav ul {
  list-style-type: none;
  display: flex;
  justify-content: center;
}

.footerNav ul li a {
  color: white;
  margin: 0 10px;
  text-decoration: none;
  font-size: 1.1em;
  opacity: 0.7;
  transition: 0.5s;
}

.footerNav ul li a:hover {
  opacity: 1;
}

.icons {
  margin-top: 10px;
  margin-left: 2%;
  display: flex;
  justify-content: center;
}

.icons a {
  background: #ecf0f3;
  position: relative;
  height: 60px;
  width: 60px;
  margin: 0 10px;
  display: inline-flex;
  text-decoration: none;
  border-radius: 50%;
  transition: all 0.3s;
  box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
}

.icons a:hover:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  border-radius: 50%;
  background: #ecf0f3;
  box-shadow: inset -3px -3px 7px #ffffff, inset 3px 3px 5px #ceced1;
}

.icons a i {
  z-index: 3;
  text-align: center;
  width: 100%;
  height: 100%;
  font-size: 25px;
  line-height: 60px;
}

.icons a:hover i {
  transform: scale(0.9);
}

.icons a.fb i {
  color: #4267b2;
}

.icons a.twitter i {
  color: #1da1f2;
}

.icons a.insta i {
  color: #e1306c;
}


.icons a.yt i {
  color: #ff0000;
}

@media (max-width: 768px) {
  .footerNav ul {
    flex-direction: column;
  }

  .icons {
    flex-wrap: wrap;
  }

  .icons a {
    margin: 10px;
  }
}
</style>
