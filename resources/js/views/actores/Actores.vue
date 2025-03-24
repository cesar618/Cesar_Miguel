<template>
  <div class="page-container">
    <h1>Actores</h1>
    <div class="actions">
      <button id="btn-add" class="btn-add" @click="goToCreateActor">
        Dar de alta
      </button>
    </div>

    <!-- Buscador -->
    <div class="search-container">
      <div class="search-group">
        <label for="search-first-name">Nombre</label>
        <input
          type="text"
          v-model="search.first_name"
          id="search-first-name"
          placeholder="Buscar por nombre"
        />
      </div>
      <div class="search-group">
        <label for="search-last-name">Apellido</label>
        <input
          type="text"
          v-model="search.last_name"
          id="search-last-name"
          placeholder="Buscar por apellido"
        />
      </div>
      <div class="search-group">
        <label for="search-phone">Móvil</label>
        <input
          type="text"
          v-model="search.phone"
          id="search-phone"
          placeholder="Buscar por móvil"
        />
      </div>
      <div class="search-group">
        <label for="search-email">Email</label>
        <input
          type="text"
          v-model="search.email"
          id="search-email"
          placeholder="Buscar por email"
        />
      </div>
      <div class="search-group">
        <label for="search-city">Ciudad</label>
        <input
          type="text"
          v-model="search.city"
          id="search-city"
          placeholder="Buscar por ciudad"
        />
      </div>
    </div>

    <!-- Tabla -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Móvil</th>
            <th>Email</th>
            <th>Ciudad</th>
            <th>Coche</th>
            <th>Carnet Conducir</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(actor, index) in filteredActores" :key="actor.id">
            <td>
              <img
                :src="
                  actor.image
                    ? `/storage/${actor.image}`
                    : '/path/to/default-image.png'
                "
                alt="Foto"
                class="actor-photo"
              />
            </td>
            <td>{{ actor.first_name }}</td>
            <td>{{ actor.last_name }}</td>
            <td>{{ actor.phone || "N/A" }}</td>
            <td>{{ actor.email || "N/A" }}</td>
            <td>{{ actor.city || "N/A" }}</td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="actor.has_car" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="actor.can_drive" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="actor.active" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <button
                :id="'btn-edit-' + index"
                class="btn-edit"
                @click="editActor(actor.id)"
              >
                Editar
              </button>
              <button
                :id="'btn-delete-' + index"
                class="btn-delete"
                @click="deleteActor(actor.id)"
              >
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
export default {
  props: {
    actores: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      search: {
        first_name: "",
        last_name: "",
        phone: "",
        email: "",
        city: "",
      },
    };
  },
  computed: {
    filteredActores() {
      return this.actores.filter((actor) => {
        return (
          (!this.search.first_name ||
            actor.first_name
              .toLowerCase()
              .includes(this.search.first_name.toLowerCase())) &&
          (!this.search.last_name ||
            actor.last_name
              .toLowerCase()
              .includes(this.search.last_name.toLowerCase())) &&
          (!this.search.phone ||
            (actor.phone &&
              actor.phone
                .toLowerCase()
                .includes(this.search.phone.toLowerCase()))) &&
          (!this.search.email ||
            (actor.email &&
              actor.email
                .toLowerCase()
                .includes(this.search.email.toLowerCase()))) &&
          (!this.search.city ||
            (actor.city &&
              actor.city
                .toLowerCase()
                .includes(this.search.city.toLowerCase())))
        );
      });
    },
  },
  methods: {
    goToCreateActor() {
      this.$inertia.visit("/actores/crear");
    },
    editActor(actorId) {
      this.$inertia.visit(`/actores/${actorId}/editar`);
    },
    deleteActor(actorId) {
      if (confirm("¿Estás seguro de que deseas eliminar este actor?")) {
        this.$inertia.delete(`/actores/${actorId}`, {
          onSuccess: () => {
            this.$inertia.visit("/actores");
          },
          onError: (errors) => {
            console.error("Error al eliminar el actor:", errors);
            alert("Hubo un error al eliminar el actor.");
          },
        });
      }
    },
  },
};
</script>

<style scoped>
/* Contenedor principal de la página */
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
}

/* Acciones */
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
  color: #fff;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 600;
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

tbody tr:hover {
  background-color: #e9e9e9;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:nth-child(odd) {
  background-color: #fff;
}

/* Botones */
.btn-edit,
.btn-delete {
  width: 80px;
  text-align: center;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 600;
}

.btn-edit {
  background-color: #28a745;
  color: #fff;
}

.btn-edit:hover {
  background-color: #218838;
}

.btn-delete {
  background-color: #e74c3c;
  color: #fff;
  margin-top: 5px;
}

.btn-delete:hover {
  background-color: #c0392b;
}

/* Foto */
.actor-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 50%;
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
  cursor: default;
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
