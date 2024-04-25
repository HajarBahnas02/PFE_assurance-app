<template>
  <form :model="form" @submit.prevent="submit" ref="contactForm">
    <div class="form-group row">
      <label ...></label>
      <div class="col-sm-10">
        <input v-model="..." required="">
      </div>
    </div>
    <div class="form-group row">
      ...
    </div>
    <div class="form-group row">
      <label for="robot" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <vue-recaptcha ref="recaptcha"
          @verify="onVerify" sitekey="/*/*/*/*/*/">
        </vue-recaptcha>
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Send</button>. 
  </form>
</template>
La