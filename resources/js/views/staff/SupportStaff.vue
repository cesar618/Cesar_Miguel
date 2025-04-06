<template>
  <div class="page-container">
    <h1>Gestión de Staff</h1>
    <div class="actions">
      <button class="btn-add" @click="goToCreateStaff">Añadir Staff</button>
    </div>

    <!-- Tabla de staff -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Rol</th>
            <th>Nivel</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(staff, index) in staffMembers" :key="staff.id">
            <td>{{ staff.role }}</td>
            <td>{{ staff.level }}</td>
            <td>{{ staff.name }}</td>
            <td>{{ staff.phone }}</td>
            <td>
              <button :id="'btn-edit-' + index" class="btn-edit" @click="editStaff(staff.id)">Editar</button>
              <button :id="'btn-delete-' + index" class="btn-delete" @click="deleteStaff(staff.id)">Eliminar</button>
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
    staffMembers: {
      type: Array,
      required: true,
    },
    eventId: {
      type: [String, Number],
      required: true,
    },
  },
  methods: {
    goToCreateStaff() {
      this.$inertia.visit(`/eventos/${this.eventId}/staff/crear`);
    },
    editStaff(staffId) {
      this.$inertia.visit(`/eventos/${this.eventId}/staff/${staffId}/editar`);
    },
    deleteStaff(staffId) {
      if (confirm('¿Estás seguro de que deseas eliminar este miembro del staff?')) {
        this.$inertia.delete(`/eventos/${this.eventId}/staff/${staffId}`, {
          onSuccess: () => {
            this.$inertia.visit(`/eventos/${this.eventId}/staff`);
          },
          onError: (errors) => {
            console.error('Error al eliminar el staff:', errors);
            alert('Hubo un error al eliminar el miembro del staff.');
          },
        });
      }
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
}

.btn-add:hover {
  opacity: 0.8;
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

th, td {
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
}

.btn-edit:hover {
  background-color: #218838;
  opacity: 0.8;
}

.btn-delete {
  background-color: #e74c3c;
  color: #fff;
}

.btn-delete:hover {
  background-color: #c0392b;
  opacity: 0.8;
}
</style>