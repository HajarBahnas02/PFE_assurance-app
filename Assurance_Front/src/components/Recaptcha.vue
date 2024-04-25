<template>
  <div>
    <h1>reCAPTCHA Test</h1>
    <form @submit.prevent="submitForm">
      <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY" ref="recaptcha"></div>
      <br><br>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ReCaptchaTest',
  data() {
    return {
      recaptchaToken: '',
    };
  },
  mounted() {
    this.loadReCaptcha();
  },
  methods: {
    loadReCaptcha() {
      const script = document.createElement('script');
      script.src = 'https://www.google.com/recaptcha/api.js';
      script.async = true;
      script.defer = true;
      document.head.appendChild(script);
    },
    async submitForm() {
      try {
        this.recaptchaToken = await this.$recaptcha('YOUR_SITE_KEY');
        const response = await axios.post('/validate-recaptcha', { recaptcha_token: this.recaptchaToken });
        if (response.data.success) {
          alert('reCAPTCHA validation successful!'); // Action à prendre si la validation réussit
        } else {
          alert('reCAPTCHA validation failed!'); // Action à prendre si la validation échoue
        }
      } catch (error) {
        console.error('Error validating reCAPTCHA:', error);
        alert('An error occurred while validating reCAPTCHA.'); // Action à prendre en cas d'erreur
      }
    },
  },
};
</script>

<style>
/* Ajoutez vos styles ici */
</style>
