<template>
  <div class="page-container">
    <h1>Gestión de Eventos</h1>
    <div class="actions">
      <button id="btn-add" class="btn-add" @click="goToCreateEvent">Dar de alta</button>
    </div>

    <!-- Tabla de eventos -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Comienzo</th>
            <th>Final</th>
            <th>Staff</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(event, index) in events" :key="event.id">
            <td>{{ event.name }}</td>
            <td>{{ event.date }}</td>
            <td>{{ event.start_time }}</td>
            <td>{{ event.end_time }}</td>
            <td>
              <button 
                :id="'btn-staff-' + index" 
                class="btn-staff" 
                @click="goToStaff(event.id)"
              >
                Ver Staff
              </button>
            </td>
            <td>
              <button :id="'btn-edit-' + index" class="btn-edit" @click="editEvent(event.id)">Editar</button>
              <button :id="'btn-delete-' + index" class="btn-delete" @click="deleteEvent(event.id)">Eliminar</button>
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
    events: {
      type: Array,
      required: true,
    },
  },
  methods: {
    goToCreateEvent() {
      this.$inertia.visit('/eventos/crear');
    },
    editEvent(eventId) {
      this.$inertia.visit(`/eventos/${eventId}/editar`);
    },
    deleteEvent(eventId) {
      if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        this.$inertia.delete(`/eventos/${eventId}`, {
          onSuccess: () => {
            this.$inertia.visit('/eventos');
          },
          onError: (errors) => {
            console.error('Error al eliminar el evento:', errors);
            alert('Hubo un error al eliminar el evento.');
          },
        });
      }
    },
    goToStaff(eventId) {
      this.$inertia.visit(`/eventos/${eventId}/staff`);
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
</style>