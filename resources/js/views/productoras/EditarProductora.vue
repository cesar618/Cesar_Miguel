<template>
  <div class="form-wrapper">
    <div class="form-container">
      <h1 class="form-title">Editar Productora</h1>

      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-grid">
          <!-- Mitad izquierda: Campos de texto y botón -->
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
              <label for="cif">CIF</label>
              <input
                type="text"
                v-model="form.cif"
                id="cif"
                required
                placeholder="Ingresa el CIF"
              />
            </div>
            <div class="form-group button-wrapper">
              <button type="submit" class="btn btn-success">
                Actualizar Productora
              </button>
            </div>
          </div>

          <!-- Mitad derecha: Foto y subida de archivo -->
          <div class="right-column">
            <div class="photo-section">
              <div class="form-group photo-group">
                <!-- Se muestra la imagen actual si existe y no se ha seleccionado una nueva -->
                <img
                  v-if="form.image && typeof form.image !== 'object'"
                  :src="`/storage/${form.image}`"
                  alt="Foto actual"
                  class="current-photo"
                />
                <label for="image">Cambiar Imagen</label>
                <input
                  type="file"
                  @change="handleFileUpload"
                  id="image"
                  class="file-input"
                />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    productora: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      form: { ...this.productora },
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0];
    },
    async submitForm() {
      const formData = new FormData();
      if (this.form.image instanceof File) {
        formData.append("image", this.form.image);
      }
      formData.append("name", this.form.name);
      formData.append("cif", this.form.cif);
      formData.append("_method", "PUT");

      await this.$inertia.post(`/productoras/${this.form.id}`, formData, {
        onSuccess: () => {
          this.$inertia.visit("/productoras");
        },
        onError: (errors) => {
          console.error("Errores de validación:", errors);
        },
      });
    },
  },
};
</script>

<style scoped>
/* Contenedor externo con márgenes elegantes */
.form-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  padding: 20px;
  width: 100%;
  box-sizing: border-box;
}

/* Contenedor del formulario ocupando casi todo el ancho */
.form-container {
  background: #ffffff;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  padding: 30px;
  width: 95vw;
  max-width: 1200px;
  box-sizing: border-box;
}

/* Título centrado */
.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  text-align: center;
  margin-bottom: 25px;
}

/* Grid para dividir el formulario en dos columnas */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

/* Mitad izquierda */
.left-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Contenedor del botón para alinearlo abajo */
.button-wrapper {
  margin-top: auto;
}

/* Mitad derecha */
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

/* Estilos para la imagen actual: tamaño fijo y centrada */
.current-photo {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin: 20px auto;
}

/* Grupos de formulario */
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

/* Botón */
.btn {
  display: block;
  width: 100%;
  padding: 12px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition:
    background-color 0.3s ease,
    transform 0.2s ease;
}

.btn:hover {
  background-color: #45a049;
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
  .right-column {
    align-items: flex-start;
  }
  .current-photo {
    width: 200px;
    height: 200px;
  }
  .button-wrapper {
    margin-top: 20px;
  }
}

@media (max-width: 480px) {
  .form-container {
    padding: 20px;
    width: 90vw;
  }
  .form-title {
    font-size: 1.5rem;
  }
  .btn {
    font-size: 1rem;
  }
}
</style>
