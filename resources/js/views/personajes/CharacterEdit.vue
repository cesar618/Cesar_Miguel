<template>
  <div class="page-container">
    <div class="header">
      <h1 class="form-title">Editar Personaje</h1>
    </div>

    <!-- Formulario de edición -->
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
              <label for="play_id">Obra</label>
              <select v-model="form.play_id" id="play_id">
                <option value="">Seleccione una obra</option>
                <option v-for="play in plays" :key="play.id" :value="play.id">
                  {{ play.name }}
                </option>
              </select>
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
          </div>
          <div class="right-column">
            <div class="photo-section">
              <div class="form-group photo-group">
                <!-- Se muestra la imagen actual si existe y no se ha seleccionado una nueva -->
                <img
                  v-if="character.image && !form.image"
                  :src="`/storage/${character.image}`"
                  alt="Foto actual"
                  class="current-photo"
                />
                <label for="image">Cambiar Imagen</label>
                <input
                  type="file"
                  @change="handleImageUpload"
                  id="image"
                  class="file-input"
                />
              </div>
            </div>
          </div>
          <div class="button-wrapper">
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    character: {
      type: Object,
      required: true,
    },
    // Recibe la lista de obras
    plays: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      form: {
        name: this.character.name || "",
        play_id: this.character.play_id || "",
        notes: this.character.notes || "",
        image: null, // Para permitir subir una nueva imagen
      },
    };
  },
  methods: {
    handleImageUpload(event) {
      this.form.image = event.target.files[0];
    },
    submitForm() {
      const formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("play_id", this.form.play_id || "");
      formData.append("notes", this.form.notes || "");
      if (this.form.image) {
        formData.append("image", this.form.image);
      }
      // Envío del formulario con método PUT para actualizar
      this.$inertia.post(`/characters/${this.character.id}`, formData, {
        onError: (errors) => {
          console.error("Errores de validación:", errors);
          alert(
            "Error al guardar el personaje: " +
              Object.values(errors).join(", "),
          );
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
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
  min-height: 100vh;
}

.header {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 30px;
}

.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
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

.right-column {
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Sección de la foto: centrado horizontal y vertical */
.photo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  min-height: 250px;
}

/* Grupo para centrar el contenido dentro de la sección de foto */
.photo-group {
  text-align: center;
  width: 100%;
}

/* Fija el tamaño de la imagen a 200x200px */
.current-photo {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin: 20px auto;
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
select,
textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  color: #333;
  background-color: #f9f9f9;
  transition:
    border-color 0.3s ease,
    box-shadow 0.3s ease;
}

input[type="text"]:focus,
select:focus,
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
  transition:
    background-color 0.3s ease,
    transform 0.2s ease;
}

.btn-success {
  background-color: #4caf50;
  color: white;
  width: 100%;
}

.btn-success:hover {
  background-color: #45a049;
  transform: translateY(-2px);
}

.button-wrapper {
  grid-column: 1 / -1;
}

@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
  .right-column {
    align-items: flex-start;
  }
}

@media (max-width: 480px) {
  .form-container {
    padding: 15px;
  }
  .form-title {
    font-size: 1.5rem;
  }
  .btn {
    font-size: 1rem;
  }
}
</style>
