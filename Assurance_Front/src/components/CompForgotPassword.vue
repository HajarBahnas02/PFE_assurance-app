<template>
    <h1>        Réccupérer mon mot de passe
    </h1>
    <form>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
</form>    
</template>
<script>
export default{
   name: 'CompForgotPassword',
    data() {
        return {
            email: ''
        }
    },
    methods: {
        submitForm() {
            console.log('Email:', this.email);
        }
    }}
</script>

