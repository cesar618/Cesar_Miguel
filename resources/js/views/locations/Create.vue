<template>
  <div class="page-container">
    <h1>Crear Locación</h1>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="city">Ciudad</label>
        <input
          type="text"
          id="city"
          v-model="form.city"
          required
          maxlength="100"
          placeholder="Nombre de la ciudad (máx. 100 caracteres)"
        />
        <span v-if="errors.city" class="error">{{ errors.city }}</span>
      </div>

      <div class="form-group">
        <label for="province">Provincia</label>
        <input
          type="text"
          id="province"
          v-model="form.province"
          required
          maxlength="100"
          placeholder="Nombre de la provincia (máx. 100 caracteres)"
        />
        <span v-if="errors.province" class="error">{{ errors.province }}</span>
      </div>

      <div class="form-group">
        <label for="region">Región</label>
        <input
          type="text"
          id="region"
          v-model="form.region"
          required
          maxlength="100"
          placeholder="Nombre de la región (máx. 100 caracteres)"
        />
        <span v-if="errors.region" class="error">{{ errors.region }}</span>
      </div>

      <div class="form-group">
        <label for="street_type">Tipo de calle</label>
        <input
          type="text"
          id="street_type"
          v-model="form.street_type"
          required
          maxlength="50"
          placeholder="Ej: Calle, Avenida (máx. 50 caracteres)"
        />
        <span v-if="errors.street_type" class="error">{{ errors.street_type }}</span>
      </div>

      <div class="form-group">
        <label for="street_name">Nombre de calle</label>
        <input
          type="text"
          id="street_name"
          v-model="form.street_name"
          required
          maxlength="100"
          placeholder="Nombre de la calle (máx. 100 caracteres)"
        />
        <span v-if="errors.street_name" class="error">{{ errors.street_name }}</span>
      </div>

      <div class="form-group">
        <label for="street_number">Número</label>
        <input
          type="text"
          id="street_number"
          v-model="form.street_number"
          required
          maxlength="20"
          placeholder="Número de la calle (máx. 20 caracteres)"
        />
        <span v-if="errors.street_number" class="error">{{ errors.street_number }}</span>
      </div>

      <div class="form-group">
        <label for="postal_code">Código Postal</label>
        <input
          type="text"
          id="postal_code"
          v-model="form.postal_code"
          required
          maxlength="20"
          placeholder="Código postal (máx. 20 caracteres)"
        />
        <span v-if="errors.postal_code" class="error">{{ errors.postal_code }}</span>
      </div>

      <div class="form-group">
        <label for="active">Activo</label>
        <input type="checkbox" id="active" v-model="form.active" />
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-submit">Guardar</button>
        <button type="button" class="btn-cancel" @click="cancel">Cancelar</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        city: '',
        province: '',
        region: '',
        street_type: '',
        street_name: '',
        street_number: '',
        postal_code: '',
        active: true, // Valor inicial por defecto
      },
      errors: {},
    };
  },
  methods: {
    submit() {
      this.$inertia.post('/location', this.form, {
        onSuccess: () => {
          this.$inertia.visit('/location');
        },
        onError: (errors) => {
          this.errors = errors;
          console.error('Error al crear la locación:', errors);
        },
      });
    },
    cancel() {
      this.$inertia.visit('/location');
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
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input,
select,
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

textarea {
  height: 100px;
  resize: vertical;
}

input[type="checkbox"] {
  margin-left: 10px;
  vertical-align: middle;
}

.error {
  color: #e74c3c;
  font-size: 0.9em;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
}

.btn-submit {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #3498db;
  color: #fff;
  cursor: pointer;
}

.btn-submit:hover {
  opacity: 0.8;
}

.btn-cancel {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #e74c3c;
  color: #fff;
  cursor: pointer;
}

.btn-cancel:hover {
  opacity: 0.8;
}
</style>