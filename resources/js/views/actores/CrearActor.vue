<template>
  <div class="page-container">
    <div class="form-container">
      <h1 class="form-title">Crear Actor</h1>

      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-grid">
          <!-- Columna izquierda: Datos y toggles -->
          <div class="left-column">
            <div class="form-group">
              <label for="first_name">Nombre</label>
              <input
                type="text"
                v-model="actor.first_name"
                id="first_name"
                required
                placeholder="Ingresa el nombre"
              />
            </div>
            <div class="form-group">
              <label for="last_name">Apellido</label>
              <input
                type="text"
                v-model="actor.last_name"
                id="last_name"
                required
                placeholder="Ingresa el apellido"
              />
            </div>
            <div class="form-group">
              <label for="phone">Móvil</label>
              <input
                type="text"
                v-model="actor.phone"
                id="phone"
                placeholder="Ingresa el número"
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                v-model="actor.email"
                id="email"
                placeholder="Ingresa el correo"
              />
            </div>
            <div class="form-group">
              <label for="city">Ciudad</label>
              <input
                type="text"
                v-model="actor.city"
                id="city"
                placeholder="Ingresa la ciudad"
              />
            </div>
            <!-- Toggle: Tiene coche -->
            <div class="form-group">
              <label for="has_car">¿Tiene coche?</label>
              <label class="switch">
                <input type="checkbox" v-model="actor.has_car" id="has_car" />
                <span class="slider"></span>
              </label>
            </div>
            <!-- Toggle: Tiene carnet de conducir -->
            <div class="form-group">
              <label for="can_drive">¿Tiene carnet de conducir?</label>
              <label class="switch">
                <input
                  type="checkbox"
                  v-model="actor.can_drive"
                  id="can_drive"
                />
                <span class="slider"></span>
              </label>
            </div>
            <!-- Toggle: Está activo -->
            <div class="form-group">
              <label for="active">¿Está activo?</label>
              <label class="switch">
                <input type="checkbox" v-model="actor.active" id="active" />
                <span class="slider"></span>
              </label>
            </div>
          </div>

          <!-- Columna derecha: Foto -->
          <div class="right-column">
            <div class="photo-section">
              <div class="form-group">
                <label for="image">Foto</label>
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
        <div class="form-group button-wrapper">
          <button type="submit" class="btn btn-success">Guardar</button>
          <Link href="/actoresRuta" class="btn btn-secondary">Cancelar</Link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      actor: {
        first_name: "",
        last_name: "",
        phone: "",
        email: "",
        city: "",
        has_car: false,
        can_drive: false,
        active: false,
        image: null,
      },
    };
  },
  methods: {
    handleFileUpload(event) {
      this.actor.image = event.target.files[0];
    },
    async submitForm() {
      console.log("submitForm ejecutado");
      const formData = new FormData();
      Object.entries(this.actor).forEach(([key, value]) => {
        // Para los booleanos se envía 1 o 0
        formData.append(
          key,
          typeof value === "boolean" ? (value ? 1 : 0) : value || "",
        );
      });

      try {
        await this.$inertia.post("/actores", formData, {
          onStart: () => console.log("Enviando solicitud..."),
          onSuccess: () => {
            console.log("Actor guardado con éxito");
            this.$inertia.visit("/actores");
          },
          onError: (errors) => console.error("Errores de validación:", errors),
        });
      } catch (error) {
        console.error("Error inesperado:", error);
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

/* Título */
.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  text-align: center;
  margin-bottom: 25px;
}

/* Grid para formulario */
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

/* Botón alineado abajo */
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

/* Toggle switch */
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

/* Botón estilo Guardar */
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

.btn-secondary {
  margin-top: 10px;
  background-color: #6c757d;
  color: #fff;
  text-align: center;
  padding: 12px;
  border-radius: 8px;
  text-decoration: none;
}

.btn:hover {
  background-color: #5f7dc8;
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
  .form-container {
    padding: 20px;
  }
  .form-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .form-title {
    font-size: 1.5rem;
  }
  .btn {
    font-size: 1rem;
  }
}
</style>
