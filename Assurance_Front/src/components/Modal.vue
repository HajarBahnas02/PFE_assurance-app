<template>
  <div v-if="isVisible" class="modal-overlay" @click="closeModal">
    <div class="modal-content">
      <span class="close" @click="closeModal">&times;</span>
      <div class="modal-body">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  width: 90%;
  max-width: 600px;
  position: relative;
  overflow-y: auto;
  max-height: 80vh;
}
.close {
  position: absolute;
  top: 10px;
  cursor: pointer;
  right: 20px;
  font-size: 25px;
  background-color: red; /* Ajout du fond rouge */
  border-radius: 50%; /* Rend le bouton de fermeture circulaire */
  width: 30px; /* Largeur */
  height: 30px; 
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-body {
  padding: 20px;
}
</style>

<script>
export default {
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    closeModal(event) {
      // Vérifie si l'événement provient du bouton de fermeture
      if (event.target.classList.contains('close')) {
        this.$emit('close');
      }
    }
  }
};
</script>
