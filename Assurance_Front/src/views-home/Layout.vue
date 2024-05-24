<template>
<nav>
        <ul class="md:flex md:items-center">
        <li class="logo-container">
          <router-link id="link" class="link" to="/">
            <img src="../assets/logo.png" width="40px" height="40px" alt="logo">
            <span class="logo-text">Shahed</span>
          </router-link>
        </li>
      </ul>
    </nav>
  </template>
  <style>
  #link:hover {
    color: #fff; 
  }

  .logo-container {
    display: flex;
  }

  .logo-text {
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; /* Change to your preferred font */
    font-size: 30px; /* Adjust the size of the text as needed */
    color: rgb(41 140 197); /* Adjust the color of the text as needed */
    margin-left: 10px; /* Space between the logo and the text */
    font-weight: bold;
    text-transform: uppercase; 
    letter-spacing: 8px; 
    text-shadow: 5px 5px 5px #999494;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    font-weight: 900;
}
</style>
  