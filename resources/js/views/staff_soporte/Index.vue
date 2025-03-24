<template>
  <div class="page-container">
    <h1>Listado de Personal de Soporte</h1>

    <!-- Botón para crear nuevo registro -->
    <div class="actions">
      <Link href="/staff-soporte/create" class="btn-add">Dar de alta</Link>
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
        <label for="search-email">Email</label>
        <input
          type="text"
          v-model="search.email"
          id="search-email"
          placeholder="Buscar por email"
        />
      </div>
    </div>

    <!-- Tabla -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Ciudad</th>
            <th>Tiene auto</th>
            <th>Sabe conducir</th>
            <th>Activo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(staff, index) in filteredStaff" :key="staff.id">
            <td>{{ staff.first_name }}</td>
            <td>{{ staff.last_name }}</td>
            <td>{{ staff.email }}</td>
            <td>{{ staff.phone || "N/A" }}</td>
            <td>{{ staff.city || "N/A" }}</td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="staff.has_car" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="staff.can_drive" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <label class="switch">
                <input type="checkbox" :checked="staff.active" disabled />
                <span class="slider"></span>
              </label>
            </td>
            <td>
              <button
                :id="'btn-edit-' + index"
                class="btn-edit"
                @click="editStaff(staff.id)"
              >
                Editar
              </button>
              <button
                :id="'btn-delete-' + index"
                class="btn-delete"
                @click="deleteStaff(staff.id)"
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
import { Link } from "@inertiajs/vue3";

export default {
  components: { Link },
  props: {
    staff: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      search: {
        first_name: "",
        last_name: "",
        email: "",
      },
    };
  },
  computed: {
    filteredStaff() {
      return this.staff.filter((staff) => {
        return (
          (!this.search.first_name ||
            staff.first_name
              .toLowerCase()
              .includes(this.search.first_name.toLowerCase())) &&
          (!this.search.last_name ||
            staff.last_name
              .toLowerCase()
              .includes(this.search.last_name.toLowerCase())) &&
          (!this.search.email ||
            (staff.email &&
              staff.email
                .toLowerCase()
                .includes(this.search.email.toLowerCase())))
        );
      });
    },
  },
  methods: {
    editStaff(id) {
      this.$inertia.visit(`/staff-soporte/${id}/edit`);
    },
    deleteStaff(id) {
      if (confirm("¿Estás seguro de eliminar este registro?")) {
        this.$inertia.delete(`/staff-soporte/${id}`);
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
  background-color: rgb(255, 255, 255);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
}

.page-container h1 {
  color: #000000;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
}

/* Estilo para las acciones */
.actions {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}

/* Botón Dar de alta: se fuerza texto blanco y se remueve el subrayado */
.btn-add {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #3498db;
  color: #fff !important;
  cursor: pointer;
  display: inline-block;
  text-decoration: none;
}

/* Contenedor del buscador */
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

/* Contenedor de la tabla */
.table-container {
  background: rgb(212, 212, 212);
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
}

/* Estilo de la tabla */
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  border: 1px solid #ccc;
  padding: 12px;
  text-align: left;
  color: #3d3c3c; /* Texto gris opaco */
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

/* Estilo común para los botones */
button {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
}

/* Forzar tamaño igual para Editar y Eliminar */
.btn-edit,
.btn-delete {
  width: 100%;
  text-align: center;
}

.btn-edit {
  background-color: #28a745;
  color: #fff;
  font-weight: 600;
}

.btn-edit:hover {
  background-color: #218838;
  opacity: 0.8;
}

.btn-delete {
  background-color: #e74c3c;
  color: #fff;
  margin-top: 5px;
  font-weight: 600;
}

.btn-delete:hover {
  background-color: #c0392b;
  opacity: 0.8;
}

/* Estilo para el toggle switch */
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
