<template>
  <div class="page-container">
    <h1>Crear Nuevo Evento</h1>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="name">Nombre</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
          required
          maxlength="50"
          placeholder="Nombre del evento (máx. 50 caracteres)"
        />
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
      </div>

      <div class="form-group">
        <label for="play_id">Obra</label>
        <select id="play_id" v-model="form.play_id">
          <option value="">Selecciona una obra (opcional)</option>
          <option v-for="play in plays" :key="play.id" :value="play.id">
            {{ play.name }}
          </option>
        </select>
        <span v-if="errors.play_id" class="error">{{ errors.play_id }}</span>
      </div>

      <div class="form-group">
        <label for="date">Fecha y Hora</label>
        <input type="datetime-local" id="date" v-model="form.date" required />
        <span v-if="errors.date" class="error">{{ errors.date }}</span>
      </div>

      <div class="form-group">
        <label for="start_time">Hora de Inicio</label>
        <input type="time" id="start_time" v-model="form.start_time" />
        <span v-if="errors.start_time" class="error">{{ errors.start_time }}</span>
      </div>

      <div class="form-group">
        <label for="end_time">Hora de Finalización</label>
        <input type="time" id="end_time" v-model="form.end_time" />
        <span v-if="errors.end_time" class="error">{{ errors.end_time }}</span>
      </div>

      <div class="form-group">
        <label for="description">Descripción</label>
        <textarea
          id="description"
          v-model="form.description"
          maxlength="100"
          placeholder="Descripción (máx. 100 caracteres)"
        ></textarea>
        <span v-if="errors.description" class="error">{{ errors.description }}</span>
      </div>

      <div class="form-group">
        <label for="url_info">URL de Información</label>
        <input
          type="url"
          id="url_info"
          v-model="form.url_info"
          maxlength="255"
          placeholder="https://ejemplo.com/info"
        />
        <span v-if="errors.url_info" class="error">{{ errors.url_info }}</span>
      </div>

      <div class="form-group">
        <label for="url_tickets">URL de Entradas</label>
        <input
          type="url"
          id="url_tickets"
          v-model="form.url_tickets"
          maxlength="255"
          placeholder="https://ejemplo.com/tickets"
        />
        <span v-if="errors.url_tickets" class="error">{{ errors.url_tickets }}</span>
      </div>

      <div class="form-group">
        <label for="location_id">Ubicación</label>
        <select id="location_id" v-model="form.location_id">
          <option value="">Selecciona una ubicación (opcional)</option>
          <option v-for="location in locations" :key="location.id" :value="location.id">
            {{ `${location.street_type} ${location.street_name} ${location.street_number}, ${location.city}, ${location.province}` }}
          </option>
        </select>
        <span v-if="errors.location_id" class="error">{{ errors.location_id }}</span>
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
  props: {
    plays: {
      type: Array,
      required: true,
    },
    locations: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      form: {
        name: '',
        play_id: '',
        date: '',
        start_time: '',
        end_time: '',
        description: '',
        url_info: '',
        url_tickets: '',
        location_id: '',
      },
      errors: {},
    };
  },
  methods: {
    submitForm() {
      this.$inertia.post('/eventos', this.form, {
        onSuccess: () => {
          this.$inertia.visit('/eventos');
        },
        onError: (errors) => {
          this.errors = errors;
        },
      });
    },
    cancel() {
      this.$inertia.visit('/eventos');
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