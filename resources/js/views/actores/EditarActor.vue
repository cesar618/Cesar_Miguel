<template>
  <div class="page-container">
    <div class="form-container">
      <h1 class="form-title">Editar Actor</h1>

      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-grid">
          <!-- Columna izquierda: Datos y toggles -->
          <div class="left-column">
            <div class="form-group">
              <label for="first_name">Nombre</label>
              <input
                type="text"
                v-model="form.first_name"
                id="first_name"
                required
                placeholder="Ingresa el nombre"
              />
            </div>
            <div class="form-group">
              <label for="last_name">Apellido</label>
              <input
                type="text"
                v-model="form.last_name"
                id="last_name"
                required
                placeholder="Ingresa el apellido"
              />
            </div>
            <div class="form-group">
              <label for="phone">Móvil</label>
              <input
                type="text"
                v-model="form.phone"
                id="phone"
                placeholder="Ingresa el número"
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                v-model="form.email"
                id="email"
                placeholder="Ingresa el correo"
              />
            </div>
            <div class="form-group">
              <label for="city">Ciudad</label>
              <input
                type="text"
                v-model="form.city"
                id="city"
                placeholder="Ingresa la ciudad"
              />
            </div>
            <!-- Toggle: Tiene coche -->
            <div class="form-group">
              <label for="has_car">¿Tiene coche?</label>
              <label class="switch">
                <input
                  type="checkbox"
                  v-model="form.has_car"
                  id="has_car"
                  :true-value="true"
                  :false-value="false"
                />
                <span class="slider"></span>
              </label>
            </div>
            <!-- Toggle: Tiene carnet de conducir -->
            <div class="form-group">
              <label for="can_drive">¿Tiene carnet de conducir?</label>
              <label class="switch">
                <input
                  type="checkbox"
                  v-model="form.can_drive"
                  id="can_drive"
                  :true-value="true"
                  :false-value="false"
                />
                <span class="slider"></span>
              </label>
            </div>
            <!-- Toggle: Está activo -->
            <div class="form-group">
              <label for="active">¿Está activo?</label>
              <label class="switch">
                <input
                  type="checkbox"
                  v-model="form.active"
                  id="active"
                  :true-value="true"
                  :false-value="false"
                />
                <span class="slider"></span>
              </label>
            </div>
            <div class="form-group button-wrapper">
              <button type="submit" class="btn btn-success">
                Actualizar Actor
              </button>
            </div>
          </div>

          <!-- Columna derecha: Foto y subida de archivo -->
          <div class="right-column">
            <div class="photo-section">
              <img
                v-if="form.image && typeof form.image === 'string'"
                :src="`/storage/${form.image}`"
                alt="Foto actual"
                class="current-photo"
              />
              <div class="form-group">
                <label for="image">Cambiar Foto</label>
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
    actor: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      // Convertir explícitamente los campos a booleanos
      form: {
        ...this.actor,
        has_car: Boolean(this.actor.has_car),
        can_drive: Boolean(this.actor.can_drive),
        active: Boolean(this.actor.active),
      },
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0];
      console.log("Archivo seleccionado:", this.form.image);
    },
    async submitForm() {
      console.log("Datos enviados:", this.form);
      const formData = new FormData();
      Object.entries(this.form).forEach(([key, value]) => {
        if (key === "image" && value instanceof File) {
          formData.append("image", value);
        } else if (key !== "image") {
          // Convertir los booleanos a 1 o 0 para enviar al backend
          formData.append(
            key,
            typeof value === "boolean" ? (value ? 1 : 0) : value || "",
          );
        }
      });
      formData.append("_method", "PUT");

      try {
        await this.$inertia.post(`/actores/${this.form.id}`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
          onStart: () => console.log("Iniciando solicitud POST..."),
          onSuccess: (page) => {
            console.log("Respuesta exitosa recibida:", page);
            this.$inertia.visit("/actores");
          },
          onError: (errors) => {
            console.error("Errores de validación:", errors);
            alert("Errores al actualizar el actor: " + JSON.stringify(errors));
          },
          onFinish: () => console.log("Solicitud finalizada"),
        });
      } catch (error) {
        console.error("Error inesperado:", error);
        alert("Error inesperado al actualizar el actor.");
      }
    },
  },
};
</script>

<style scoped>
/* Contenedor principal */
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
  min-height: 100vh;
}

/* Contenedor del formulario */
.form-container {
  padding: 30px;
}

/* Título del formulario */
.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  text-align: center;
  margin-bottom: 25px;
}

/* Grid para dividir el formulario */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

/* Columna izquierda */
.left-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Botón para alinear al final */
.button-wrapper {
  margin-top: auto;
}

/* Columna derecha */
.right-column {
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Sección de foto */
.photo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

.current-photo {
  width: 100%;
  max-width: 300px;
  height: auto;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 20px;
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
input[type="email"] {
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
input[type="email"]:focus {
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

/* Estilo del toggle switch */
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 20px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745;
}

input:checked + .slider:before {
  transform: translateX(20px);
}
</style>
