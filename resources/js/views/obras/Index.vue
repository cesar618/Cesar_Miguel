<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
  plays: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({});

const editPlay = (id) => {
  router.visit(`/obras/${id}/edit`, { method: "get" });
};

const deletePlay = (id) => {
  if (confirm("¿Seguro que deseas eliminar esta obra?")) {
    form.delete(`/obras/${id}`);
  }
};

// Búsqueda
const searchName = ref("");
const searchProducer = ref("");

const filteredPlays = computed(() => {
  return props.plays.filter((play) => {
    const matchesName = play.name
      .toLowerCase()
      .includes(searchName.value.toLowerCase());
    const matchesProducer = play.producer
      ? play.producer.name
          .toLowerCase()
          .includes(searchProducer.value.toLowerCase())
      : "sin productora".includes(searchProducer.value.toLowerCase());

    return matchesName && matchesProducer;
  });
});
</script>

<template>
  <div class="page-container">
    <h1>Listado de Obras</h1>

    <div class="actions">
      <a href="/obras/create" class="btn-add">Dar de alta</a>
    </div>

    <!-- Campos de búsqueda -->
    <div class="search-fields">
      <input
        type="text"
        v-model="searchName"
        placeholder="Buscar por nombre"
        class="search-input"
      />
      <input
        type="text"
        v-model="searchProducer"
        placeholder="Buscar por productora"
        class="search-input"
      />
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Productora</th>
            <th>Fecha</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="play in filteredPlays" :key="play.id">
            <td>{{ play.name }}</td>
            <td>{{ play.producer ? play.producer.name : "Sin productora" }}</td>
            <td>
              {{ play.date ? new Date(play.date).toLocaleDateString() : "N/A" }}
            </td>
            <td>{{ play.active ? "Sí" : "No" }}</td>
            <td>
              <button @click="editPlay(play.id)" class="btn-edit">
                Editar
              </button>
              <button @click="deletePlay(play.id)" class="btn-delete">
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: rgb(255, 255, 255);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
}

.actions {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}

.btn-add {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #3498db;
  color: #fff !important;
  cursor: pointer;
  text-decoration: none;
}

.table-container {
  background: rgb(212, 212, 212);
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  border: 1px solid #ccc;
  padding: 12px;
  text-align: left;
}

th {
  background-color: #f4f4f4;
  font-weight: bold;
}

td {
  background-color: #fafafa;
}

button {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
}

.btn-edit {
  background-color: #28a745;
  color: #fff;
  font-weight: 600;
}

.btn-delete {
  background-color: #e74c3c;
  color: #fff;
  font-weight: 600;
}

/* Campos de búsqueda */
.search-fields {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}

.search-input {
  flex: 1;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
}
</style>
