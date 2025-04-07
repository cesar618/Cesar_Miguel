<template>
  <div class="page-container">
    <!-- Sección de Locaciones -->
    <h1>Gestión de Locaciones</h1>
    <div class="actions">
      <button id="btn-add" class="btn-add" @click="goToCreateLocation">Dar de alta</button>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Ciudad</th>
            <th>Provincia</th>
            <th>Dirección</th>
            <th>Activo</th>
            <th>Mapa</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(location, index) in locations" :key="location.id">
            <td>{{ location.city }}</td>
            <td>{{ location.province }}</td>
            <td>{{ `${location.street_type} ${location.street_name} ${location.street_number}` }}</td>
            <td>{{ location.active ? 'Sí' : 'No' }}</td>
            <td>
              <a
                :href="`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(`${location.street_type} ${location.street_name} ${location.street_number}, ${location.city}, ${location.province}, ${location.postal_code}`)}`"
                target="_blank"
                class="map-link"
              >
                Ver en Google Maps
              </a>
            </td>
            <td>
              <button :id="'btn-view-' + index" class="btn-staff" @click="viewLocation(location)">Ver</button>
              <button :id="'btn-edit-' + index" class="btn-edit" @click="editLocation(location.id)">Editar</button>
              <button :id="'btn-delete-' + index" class="btn-delete" @click="deleteLocation(location.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal para ver detalles de locación -->
    <div v-if="selectedLocation" class="modal">
      <div class="modal-content">
        <h2>Detalles de Locación</h2>
        <p><strong>Ciudad:</strong> {{ selectedLocation.city }}</p>
        <p><strong>Provincia:</strong> {{ selectedLocation.province }}</p>
        <p><strong>Región:</strong> {{ selectedLocation.region }}</p>
        <p><strong>Dirección:</strong> {{ `${selectedLocation.street_type} ${selectedLocation.street_name} ${selectedLocation.street_number}` }}</p>
        <p><strong>Código Postal:</strong> {{ selectedLocation.postal_code }}</p>
        <p><strong>URL Mapa:</strong> {{ selectedLocation.url_map || 'N/A' }}</p>
        <p><strong>Teléfono:</strong> {{ selectedLocation.phone || 'N/A' }}</p>
        <p><strong>Activo:</strong> {{ selectedLocation.active ? 'Sí' : 'No' }}</p>
        <p><strong>Notas:</strong> {{ selectedLocation.notes || 'Sin notas' }}</p>
        <button class="btn-close" @click="selectedLocation = null">Cerrar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    locations: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      selectedLocation: null,
    };
  },
  methods: {
    goToCreateLocation() {
      this.$inertia.visit('/location/create');
    },
    editLocation(locationId) {
      this.$inertia.visit(`/location/${locationId}/edit`);
    },
    deleteLocation(locationId) {
      if (confirm('¿Estás seguro de que deseas eliminar esta locación?')) {
        this.$inertia.delete(`/location/${locationId}`, {
          onSuccess: () => {
            this.$inertia.visit('/location');
          },
          onError: (errors) => {
            console.error('Error al eliminar la locación:', errors);
            alert('Hubo un error al eliminar la locación.');
          },
        });
      }
    },
    viewLocation(location) {
      this.selectedLocation = location;
    },
  },
};
</script>

<style scoped>
/* Contenedor principal de la página */
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: rgb(255, 255, 255); /* Blanco */
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
}

/* Estilo para las acciones */
.actions {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}

.btn-add {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #3498db; /* Celeste */
  color: #fff;
  cursor: pointer;
}

.btn-add:hover {
  opacity: 0.8;
}

/* Contenedor de la tabla */
.table-container {
  background: rgb(212, 212, 212); /* Gris claro */
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

/* Estilo de los botones */
button {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
}

.btn-edit {
  background-color: #28a745; /* Verde */
  color: #fff;
}

.btn-edit:hover {
  background-color: #218838; /* Verde más oscuro */
  opacity: 0.8;
}

.btn-delete {
  background-color: #e74c3c; /* Rojo */
  color: #fff;
}

.btn-delete:hover {
  background-color: #c0392b; /* Rojo más oscuro */
  opacity: 0.8;
}

.btn-staff {
  background-color: #8e44ad; /* Púrpura */
  color: #fff;
}

.btn-staff:hover {
  background-color: #732d91; /* Púrpura más oscuro */
  opacity: 0.8;
}

/* Estilo del enlace de mapa */
.map-link {
  color: #3498db;
  text-decoration: none;
}

.map-link:hover {
  text-decoration: underline;
}

/* Estilo del modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  max-width: 500px;
  width: 100%;
}

.btn-close {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #3498db;
  color: white;
  cursor: pointer;
  margin-top: 10px;
  display: block;
  margin-left: auto;
}

.btn-close:hover {
  opacity: 0.8;
}
</style>