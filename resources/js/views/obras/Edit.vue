<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  play: {
    type: Object,
    required: true,
  },
  productoras: {
    type: Array,
    default: () => [],
  },
  characters: {
    type: Array,
    default: () => [],
  },
});

// Inicializamos el formulario con los datos actuales de la obra a editar
const form = useForm({
  name: props.play.name,
  producer_id: props.play.producer_id,
  active: props.play.active,
  notes: props.play.notes ?? "",
  // Si la obra ya tiene personajes asociados, se asume que viene en un array de IDs
  character_ids: props.play.character_ids ? [...props.play.character_ids] : [],
});

// Función para enviar la actualización
const submit = () => {
  form.put(`/obras/${props.play.id}`, {
    onFinish: () => {
      // Opcional: acciones adicionales luego de actualizar
    },
  });
};
</script>

<template>
  <div class="page-container">
    <div class="header">
      <h1 class="form-title">Editar Obra</h1>
    </div>

    <!-- Formulario de edición -->
    <div class="form-container">
      <form @submit.prevent="submit" class="elegant-form">
        <!-- Campo: Nombre -->
        <div class="form-group">
          <label for="name">Nombre</label>
          <input
            type="text"
            id="name"
            v-model="form.name"
            placeholder="Ingresa el nombre de la obra"
            required
          />
          <span v-if="form.errors.name" class="error-message">
            {{ form.errors.name }}
          </span>
        </div>

        <!-- Campo: Productora (select) -->
        <div class="form-group">
          <label for="producer_id">Productora</label>
          <select id="producer_id" v-model="form.producer_id" required>
            <option disabled value="">Seleccione una productora</option>
            <option
              v-for="producer in productoras"
              :key="producer.id"
              :value="producer.id"
            >
              {{ producer.name }}
            </option>
          </select>
          <span v-if="form.errors.producer_id" class="error-message">
            {{ form.errors.producer_id }}
          </span>
        </div>

        <!-- Campo: Activo -->
        <div class="form-group">
          <label for="active">Activo</label>
          <select v-model="form.active" id="active">
            <option :value="true">Sí</option>
            <option :value="false">No</option>
          </select>
          <span v-if="form.errors.active" class="error-message">
            {{ form.errors.active }}
          </span>
        </div>

        <!-- Campo: Notas -->
        <div class="form-group">
          <label for="notes">Notas</label>
          <textarea
            id="notes"
            v-model="form.notes"
            placeholder="Ingresa las notas"
            rows="3"
          ></textarea>
          <span v-if="form.errors.notes" class="error-message">
            {{ form.errors.notes }}
          </span>
        </div>

        <!-- Sección: Selección de Personajes -->
        <div class="form-group">
          <label>Personajes:</label>
          <div class="cards-container">
            <div
              v-for="character in characters"
              :key="character.id"
              class="character-card"
            >
              <img
                :src="
                  character.image
                    ? `/storage/${character.image}`
                    : '/path/to/default-Personaje.png'
                "
                alt="Foto del personaje"
                class="character-photo"
              />
              <div class="character-info">
                <span>{{ character.name }}</span>
                <input
                  type="checkbox"
                  :value="character.id"
                  v-model="form.character_ids"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="form-group button-wrapper">
          <button type="submit" class="btn btn-success">Actualizar</button>
          <Link href="/obras" class="btn btn-secondary">Cancelar</Link>
        </div>
      </form>
    </div>
  </div>
</template>

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
input[type="email"],
input[type="number"],
select,
textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  color: #333;
  background-color: #fff;
  transition:
    border-color 0.3s ease,
    box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="number"]:focus,
select:focus,
textarea:focus {
  border-color: #4caf50;
  box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
  outline: none;
}

.button-wrapper {
  margin-top: 20px;
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
  color: #fff;
}

.btn-success:hover {
  background-color: #45a049;
  transform: translateY(-2px);
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

.error-message {
  color: red;
  font-size: 0.9rem;
  margin-top: 5px;
}

/* Estilos para las tarjetas de personajes */
.cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
}

.character-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 10px;
  text-align: center;
  width: 150px;
}

.character-photo {
  width: 100%;
  height: 100px;
  object-fit: cover;
  border-radius: 5px;
  margin-bottom: 10px;
}

.character-info {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.character-info span {
  margin-bottom: 5px;
}
</style>
