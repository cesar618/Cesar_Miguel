<template>
  <div class="page-container">
    <!-- Formulario de edición -->
    <div class="form-container">
      <h1 class="form-title">Editar Actor</h1>

      <form @submit.prevent="submitForm" class="elegant-form">
        <div class="form-grid">
          <!-- Mitad izquierda: Campos de texto, checkboxes y botón -->
          <div class="left-column">
            <div class="form-group">
              <label for="first_name">Nombre</label>
              <input type="text" v-model="form.first_name" id="first_name" required placeholder="Ingresa el nombre" />
            </div>
            <div class="form-group">
              <label for="last_name">Apellido</label>
              <input type="text" v-model="form.last_name" id="last_name" required placeholder="Ingresa el apellido" />
            </div>
            <div class="form-group">
              <label for="phone">Móvil</label>
              <input type="text" v-model="form.phone" id="phone" placeholder="Ingresa el número" />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" v-model="form.email" id="email" placeholder="Ingresa el correo" />
            </div>
            <div class="form-group">
              <label for="city">Ciudad</label>
              <input type="text" v-model="form.city" id="city" placeholder="Ingresa la ciudad" />
            </div>
            <div class="form-group checkbox-group">
              <input type="checkbox" v-model="form.has_car" id="has_car" />
              <label for="has_car">¿Tiene coche?</label>
            </div>
            <div class="form-group checkbox-group">
              <input type="checkbox" v-model="form.can_drive" id="can_drive" />
              <label for="can_drive">¿Tiene carnet de conducir?</label>
            </div>
            <div class="form-group checkbox-group">
              <input type="checkbox" v-model="form.active" id="active" />
              <label for="active">¿Está activo?</label>
            </div>
            <div class="form-group button-wrapper">
              <button type="submit" class="btn btn-success">Actualizar Actor</button>
            </div>
          </div>

          <!-- Mitad derecha: Foto y subida de archivo -->
          <div class="right-column">
            <div class="photo-section">
              <img
                v-if="form.image && typeof form.image === 'string'"
                :src="`/storage/${form.image}`"
                alt="Foto actual"
                class="current-photo"
              />
              <div class="form-group">
                <label for="image">Cambiar Foto</label>
                <input type="file" @change="handleFileUpload" id="image" class="file-input" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Tabla de actores debajo del formulario -->
    <div class="table-section">
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
            <tr v-for="(actorItem, index) in actores" :key="actorItem.id">
              <td>
                <img
                  :src="actorItem.image ? `/storage/${actorItem.image}` : '/path/to/default-image.jpg'"
                  alt="Foto"
                  class="actor-photo"
                />
              </td>
              <td>{{ actorItem.first_name }}</td>
              <td>{{ actorItem.last_name }}</td>
              <td>{{ actorItem.phone || 'N/A' }}</td>
              <td>{{ actorItem.email || 'N/A' }}</td>
              <td>{{ actorItem.city || 'N/A' }}</td>
              <td>{{ actorItem.has_car ? 'Sí' : 'No' }}</td>
              <td>{{ actorItem.can_drive ? 'Sí' : 'No' }}</td>
              <td>{{ actorItem.active ? 'Sí' : 'No' }}</td>
              <td>
                <button :id="'btn-edit-' + index" class="btn-edit" @click="editActor(actorItem.id)">Editar</button>
                <button :id="'btn-delete-' + index" class="btn-delete" @click="deleteActor(actorItem.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    actor: {
      type: Object,
      required: true,
    },
    actores: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      form: { ...this.actor }, // Clonamos los datos del actor para editarlos
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0];
    },
    async submitForm() {
      const formData = new FormData();
      Object.entries(this.form).forEach(([key, value]) => {
        if (key !== 'image' || (key === 'image' && value instanceof File)) {
          formData.append(key, typeof value === 'boolean' ? (value ? 1 : 0) : value || '');
        }
      });
      formData.append('_method', 'PUT');

      try {
        await this.$inertia.post(`/actores/${this.form.id}`, formData, {
          onSuccess: () => {
            this.$inertia.visit(`/actores/${this.form.id}/editar`); // Recarga la página tras éxito
          },
          onError: (errors) => {
            console.error('Errores de validación:', errors);
          },
        });
      } catch (error) {
        console.error('Error al actualizar el actor:', error);
      }
    },
    editActor(actorId) {
      this.$inertia.visit(`/actores/${actorId}/editar`);
    },
    deleteActor(actorId) {
      if (confirm('¿Estás seguro de que deseas eliminar este actor?')) {
        this.$inertia.delete(`/actores/${actorId}`, {
          onSuccess: () => {
            this.$inertia.visit(`/actores/${this.form.id}/editar`); // Recarga la página tras eliminar
          },
          onError: (errors) => {
            console.error('Error al eliminar el actor:', errors);
            alert('Hubo un error al eliminar el actor.');
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
  background-color: rgb(255, 255, 255); /* Blanco */
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
  min-height: 100vh;
}

/* Contenedor del formulario */
.form-container {
  padding: 30px;
  border-bottom: 1px solid #ddd; /* Separador entre formulario y tabla */
}

/* Título del formulario */
.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  text-align: center;
  margin-bottom: 25px;
}

/* Grid para dividir el formulario */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Dos columnas de igual ancho */
  gap: 20px;
}

/* Mitad izquierda */
.left-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Contenedor del botón para alinearlo abajo */
.button-wrapper {
  margin-top: auto; /* Empuja el botón al final de la columna izquierda */
}

/* Mitad derecha */
.right-column {
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Sección de la foto */
.photo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

.current-photo {
  width: 100%;
  max-width: 300px;
  height: auto;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 20px;
}

/* Grupos de formulario */
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
input[type="email"] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  color: #333;
  background-color: #f9f9f9;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus {
  border-color: #4CAF50;
  box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
  outline: none;
}

.file-input {
  width: 100%;
  padding: 10px;
  border: 1px dashed #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
  font-size: 0.9rem;
  color: #666;
}

/* Checkbox */
.checkbox-group {
  display: flex;
  align-items: center;
  gap: 10px;
}

.checkbox-group input[type="checkbox"] {
  width: 20px;
  height: 20px;
  accent-color: #4CAF50;
}

.checkbox-group label {
  margin-bottom: 0;
  font-size: 1rem;
  color: #555;
}

/* Botón del formulario */
.btn {
  display: block;
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn:hover {
  background-color: #45a049;
  transform: translateY(-2px);
}

/* Sección de la tabla */
.table-section {
  padding: 20px;
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

/* Estilo de los botones de la tabla */
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
  background-color: #e74c3c;
  color: #fff;
}

button:hover {
  opacity: 0.8;
}

/* Estilo de la foto en la tabla */
.actor-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 50%;
}

/* Responsive */
@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr; /* Una columna en pantallas pequeñas */
  }

  .right-column {
    align-items: flex-start;
  }

  .current-photo {
    max-width: 200px;
  }

  .button-wrapper {
    margin-top: 20px; /* Espacio adicional en pantallas pequeñas */
  }
}

@media (max-width: 480px) {
  .form-container,
  .table-section {
    padding: 15px;
  }

  .form-title {
    font-size: 1.5rem;
  }

  .btn {
    font-size: 1rem;
  }
}
</style>