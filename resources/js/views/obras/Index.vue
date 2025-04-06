<template>
  <div class="page-container">
    <h1>Listado de Obras</h1>

    <div class="actions">
      <a href="/obras/create" class="btn-add">Dar de alta</a>
    </div>

    <!-- Buscador -->
    <div class="search-container">
      <div class="search-group">
        <label for="search-name">Nombre</label>
        <input
          type="text"
          v-model="searchName"
          id="search-name"
          placeholder="Buscar por nombre"
        />
      </div>
      <div class="search-group">
        <label for="search-producer">Productora</label>
        <input
          type="text"
          v-model="searchProducer"
          id="search-producer"
          placeholder="Buscar por productora"
        />
      </div>
    </div>

    <!-- Tabla -->
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
                      alt="Foto"
                      class="character-photo-small"
                    />
                    <span>{{ character.name }}</span>
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
            <td class="actions-cell">
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
import axios from "axios";

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
      openDropdowns: {},
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
      router.visit(`/obras/${id}/edit`);
    },
    deletePlay(id) {
      this.$swal
        .fire({
          title: "¿Estás seguro?",
          text: "La obra será eliminada !!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Eliminar",
          cancelButtonText: "Cancelar",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.form
              .delete(`/obras/${id}`)
              .then(() => {
                this.$swal.fire({
                  icon: "success",
                  title: "Eliminada",
                  text: "La obra ha sido eliminada correctamente.",
                });
              })
              .catch((error) => {
                console.error("Error al eliminar la obra", error);
                this.$swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Hubo un error al eliminar la obra.",
                });
              });
          }
        });
    },
    toggleDropdown(playId) {
      this.openDropdowns[playId] = !this.openDropdowns[playId];
    },
    removeCharacter(playId, characterId) {
      this.$swal
        .fire({
          title: "¿Estás seguro?",
          text: "El personaje se retirará de la obra.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Eliminar",
          cancelButtonText: "Cancelar",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(`/obras/${playId}/characters/${characterId}`)
              .then(() => {
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

.page-container h1 {
  color: #000;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
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
  font-size: 1rem;
  font-weight: 600;
}

.btn-add:hover {
  opacity: 0.8;
}

/* Buscador */
.search-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 15px;
  margin-bottom: 20px;
}

.search-group {
  display: flex;
  flex-direction: column;
}

.search-group label {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 5px;
}

.search-group input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  background-color: #f9f9f9;
}

/* Tabla */
.table-container {
  background: #d4d4d4;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
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

tbody tr:hover {
  background-color: #e9e9e9;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:nth-child(odd) {
  background-color: #ffffff;
}

/* Botones */
.actions-cell button {
  display: block;
  width: 100%;
  margin-bottom: 5px;
}

.btn-edit {
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
}

.btn-edit:hover {
  background-color: #218838;
  opacity: 0.8;
}

.btn-delete {
  background-color: #e74c3c;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
}

.btn-edit,
.btn-delete {
  width: 80px;
  text-align: center;
}

.btn-delete:hover {
  background-color: #c0392b;
  opacity: 0.8;
}

/* Dropdown de personajes */
.dropdown-container {
  position: relative;
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
  width: 250px;
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

.btn-remove-character {
  background: transparent;
  border: none;
  color: #e74c3c;
  font-weight: bold;
  cursor: pointer;
  font-size: 0.9rem;
  margin-left: auto;
}

/* Responsive */
@media (max-width: 768px) {
  .btn-edit,
  .btn-delete {
    width: 100%;
    font-size: 0.9rem;
  }

  th,
  td {
    font-size: 0.9rem;
    padding: 10px;
  }

  .search-container {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .actions {
    justify-content: flex-start;
  }

  .btn-add {
    width: 100%;
    margin-top: 10px;
  }

  .btn-edit,
  .btn-delete {
    padding: 5px 10px;
    font-size: 0.8rem;
  }

  th,
  td {
    padding: 8px;
    font-size: 0.85rem;
  }
}
</style>
