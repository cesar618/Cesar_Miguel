<!-- resources/js/Pages/CharacterForm.vue -->
<template>
  <div class="page-container">
    <div class="header">
      <h1 class="form-title">Personajes</h1>
    </div>

    <!-- Formulario de creación -->
    <div class="form-container">
      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-grid">
          <div class="left-column">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input
                type="text"
                v-model="form.name"
                id="name"
                required
                placeholder="Ingresa el nombre"
              />
            </div>
            <div class="form-group">
              <label for="notes">Notas</label>
              <textarea
                v-model="form.notes"
                id="notes"
                placeholder="Ingresa las notas"
                rows="3"
              ></textarea>
            </div>
            <div class="form-group button-wrapper">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
          <div class="right-column">
            <div class="photo-section">
              <div class="form-group">
                <label for="image">Foto</label>
                <input
                  type="file"
                  @change="handleImageUpload"
                  id="image"
                  class="file-input"
                />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Lista de personajes -->
    <CharacterList :characters="characters" />
  </div>
</template>

<script>
import CharacterList from '../views/CharacterList.vue'; // Importamos el componente

export default {
  components: {
    CharacterList,
  },
  props: {
    characters: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      form: {
        name: '',
        notes: '',
        image: null,
      },
    };
  },
  methods: {
    handleImageUpload(event) {
      this.form.image = event.target.files[0];
    },
    submitForm() {
      const formData = new FormData();
      formData.append('name', this.form.name);
      formData.append('notes', this.form.notes || '');
      if (this.form.image) {
        formData.append('image', this.form.image);
      }

      this.$inertia.post('/characters', formData, {
        preserveState: false, // Recarga completa para actualizar la tabla
        onSuccess: () => {
          // Limpiar el formulario tras guardar
          this.form.name = '';
          this.form.notes = '';
          this.form.image = null;
        },
        onError: (errors) => {
          console.error('Errores de validación:', errors);
          alert('Error al guardar el personaje: ' + Object.values(errors).join(', '));
        },
      });
    },
  },
};
</script>

<style scoped>
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: rgb(255, 255, 255);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
  min-height: 100vh;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  margin-left: 20px;
}

.form-container {
  padding: 30px;
  border-bottom: 1px solid #ddd;
}

.elegant-form {
  width: 100%;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.left-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.button-wrapper {
  margin-top: auto;
}

.right-column {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.photo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

.form-group {
  margin-bottom: 20px;
  width: 100%;
}

label {
  display: block;
  font-size: 1rem;
  color: #555;
  margin-bottom: 5px;
  font-weight: 500;
}

input[type="text"],
textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  color: #333;
  background-color: #f9f9f9;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
textarea:focus {
  border-color: #4caf50;
  box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
  outline: none;
}

.file-input {
  width: 100%;
  padding: 10px;
  border: 1px dashed #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
  font-size: 0.9rem;
  color: #666;
}

.btn {
  display: block;
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-success {
  background-color: #4caf50;
  color: white;
}

.btn-success:hover {
  background-color: #45a049;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
  .right-column {
    align-items: flex-start;
  }
  .button-wrapper {
    margin-top: 20px;
  }
}

@media (max-width: 480px) {
  .form-container {
    padding: 15px;
  }
  .form-title {
    font-size: 1.5rem;
    margin-left: 10px;
  }
  .btn {
    font-size: 1rem;
  }
}
</style>