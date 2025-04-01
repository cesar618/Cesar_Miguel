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
            <th>Activo</th>
            <th>Personajes</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="play in filteredPlays" :key="play.id">
            <td>{{ play.name }}</td>
            <td>{{ play.producer ? play.producer.name : "Sin productora" }}</td>
            <td>{{ play.active ? "Sí" : "No" }}</td>
            <td>
              <div class="dropdown-container">
                <button @click="toggleDropdown(play.id)" class="btn-dropdown">
                  Ver personajes
                </button>
                <div v-if="openDropdowns[play.id]" class="dropdown-content">
                  <div
                    v-for="character in play.characters"
                    :key="character.id"
                    class="character-item"
                  >
                    <img
                      :src="
                        character.image
                          ? `/storage/${character.image}`
                          : '/path/to/default-Personaje.png'
                      "
                      alt="Foto del personaje"
                      class="character-photo-small"
                    />
                    <span>{{ character.name }}</span>
                    <!-- Botón para eliminar el personaje de la obra -->
                    <button
                      class="btn-remove-character"
                      @click.stop="removeCharacter(play.id, character.id)"
                    >
                      x
                    </button>
                  </div>
                </div>
              </div>
            </td>
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

<script>
import { useForm, router } from "@inertiajs/vue3";
import axios from "axios"; // Asegúrate de tener axios instalado e importado

export default {
  props: {
    plays: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      form: useForm({}),
      searchName: "",
      searchProducer: "",
      openDropdowns: {}, // Para controlar el dropdown por obra
    };
  },
  computed: {
    filteredPlays() {
      return this.plays.filter((play) => {
        const matchesName = play.name
          .toLowerCase()
          .includes(this.searchName.toLowerCase());
        const matchesProducer = play.producer
          ? play.producer.name
              .toLowerCase()
              .includes(this.searchProducer.toLowerCase())
          : "sin productora".includes(this.searchProducer.toLowerCase());
        return matchesName && matchesProducer;
      });
    },
  },
  methods: {
    editPlay(id) {
      router.visit(`/obras/${id}/edit`, { method: "get" });
    },
    deletePlay(id) {
      if (confirm("¿Seguro que deseas eliminar esta obra?")) {
        this.form.delete(`/obras/${id}`);
      }
    },
    toggleDropdown(playId) {
      this.openDropdowns[playId] = !this.openDropdowns[playId];
    },
    removeCharacter(playId, characterId) {
      this.$swal
        .fire({
          title: "¿Estas seguro?",
          text: "El personaje será eliminado !!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Delete",
          cancelButtonText: "Cancel",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(`/obras/${playId}/characters/${characterId}`)
              .then((response) => {
                this.$swal.fire({
                  icon: "success",
                  title: "Eliminado",
                  text: "El personaje fue removido de la obra.",
                });
                this.$inertia.reload();
              })
              .catch((error) => {
                console.error("Error al eliminar personaje", error);
                this.$swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Hubo un error al eliminar el personaje.",
                });
              });
          }
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
  color: #3d3c3c;
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

/* Estilos para el dropdown de personajes */
.dropdown-container {
  position: relative; /* Contenedor de referencia */
  display: inline-block;
}

.btn-dropdown {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.dropdown-content {
  position: absolute;
  top: 100%;
  left: 0;
  margin-top: 5px;
  background: #fff;
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  z-index: 100;
}

.character-item {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-bottom: 5px;
}

.character-photo-small {
  width: 30px;
  height: 30px;
  object-fit: cover;
  border-radius: 50%;
}

/* Estilos para el botón de eliminación de personaje */
.btn-remove-character {
  background: transparent;
  border: none;
  color: #e74c3c;
  font-weight: bold;
  cursor: pointer;
  font-size: 0.9rem;
  margin-left: auto;
}
</style>
