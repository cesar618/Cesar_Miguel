<template>
  <div class="form-wrapper">
    <div class="form-container">
      <h1 class="form-title">Crear Productora</h1>

      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-group">
          <label for="image">Foto</label>
          <input
            type="file"
            @change="handleFileUpload"
            id="image"
            class="file-input"
          />
        </div>
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
        <div class="form-group">
          <button type="submit" class="btn btn-success">Guardar</button>
          <Link href="/productoras" class="btn btn-secondary">Cancelar</Link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        image: null,
        name: "",
        cif: "",
      },
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0];
    },
    async submitForm() {
      const formData = new FormData();
      if (this.form.image) {
        formData.append("image", this.form.image);
      }
      formData.append("name", this.form.name);
      formData.append("cif", this.form.cif);

      await this.$inertia.post("/productoras", formData, {
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
  padding: 40px; /* Margen externo amplio en todos los lados */
  width: 100%;
  box-sizing: border-box;
}

/* Contenedor del formulario ocupando todo el ancho disponible con límite máximo */
.form-container {
  background: #ffffff;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  padding: 30px;
  width: 100%; /* Ocupa todo el ancho del contenedor padre */
  max-width: 1200px; /* Límite máximo para pantallas grandes */
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

/* Grupos de formulario */
.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-size: 1rem;
  color: #555;
  margin-bottom: 5px;
  font-weight: 500;
}

input[type="text"] {
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

input[type="text"]:focus {
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
  .form-wrapper {
    padding: 30px; /* Margen más pequeño en pantallas medianas */
  }

  .form-container {
    padding: 20px;
  }
}

@media (max-width: 480px) {
  .form-wrapper {
    padding: 20px; /* Margen aún más pequeño en pantallas pequeñas */
  }

  .form-title {
    font-size: 1.5rem;
  }

  .btn {
    font-size: 1rem;
  }
}
</style>
