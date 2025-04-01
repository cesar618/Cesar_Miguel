<template>
  <div class="page-container">
    <h1>Productoras</h1>
    <div class="actions">
      <button id="btn-add" class="btn-add" @click="goToCreateProducer">
        Dar de alta
      </button>
    </div>

    <!-- Buscador -->
    <div class="search-container">
      <div class="search-group">
        <label for="search-name">Nombre</label>
        <input
          type="text"
          v-model="search.name"
          id="search-name"
          placeholder="Buscar por nombre"
        />
      </div>
      <div class="search-group">
        <label for="search-cif">CIF</label>
        <input
          type="text"
          v-model="search.cif"
          id="search-cif"
          placeholder="Buscar por CIF"
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
            <th>CIF</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(productora, index) in filteredProductoras"
            :key="productora.id"
          >
            <td>
              <img
                :src="
                  productora.image
                    ? `/storage/${productora.image}`
                    : '/path/to/default-Productora.png'
                "
                alt="Foto"
                class="producer-photo"
              />
            </td>
            <td>{{ productora.name }}</td>
            <td>{{ productora.cif }}</td>
            <td>
              <button
                :id="'btn-edit-' + index"
                class="btn-edit"
                @click="editProducer(productora.id)"
              >
                Editar
              </button>
              <button
                :id="'btn-delete-' + index"
                class="btn-delete"
                @click="deleteProducer(productora.id)"
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
    productoras: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      search: {
        name: "",
        cif: "",
      },
    };
  },
  computed: {
    filteredProductoras() {
      return this.productoras.filter((productora) => {
        return (
          (!this.search.name ||
            productora.name
              .toLowerCase()
              .includes(this.search.name.toLowerCase())) &&
          (!this.search.cif ||
            productora.cif
              .toLowerCase()
              .includes(this.search.cif.toLowerCase()))
        );
      });
    },
  },
  methods: {
    goToCreateProducer() {
      this.$inertia.visit("/productoras/crear");
    },
    editProducer(id) {
      this.$inertia.visit(`/productoras/${id}/editar`);
    },
    deleteProducer(id) {
      // Busca la productora por id en el array recibido como prop
      const productora = this.productoras.find((p) => p.id === id);
      // Si la productora tiene obras asociadas, muestra un mensaje de error
      if (productora && productora.plays_count > 0) {
        this.$swal.fire({
          icon: "error",
          title: "No se puede eliminar",
          text: "Productora actualmente en uso.",
        });
        return;
      }
      // Muestra la confirmación personalizada
      this.$swal
        .fire({
          title: "¿Estás seguro?",
          text: "La productora será eliminada !!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Delete",
          cancelButtonText: "Cancel",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$inertia.delete(`/productoras/${id}`, {
              onSuccess: () => {
                this.$swal.fire({
                  icon: "success",
                  title: "Eliminada",
                  text: "La productora ha sido eliminada.",
                });
                this.$inertia.visit("/productoras");
              },
              onError: (errors) => {
                console.error("Error al eliminar la productora:", errors);
                this.$swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Hubo un error al eliminar la productora.",
                });
              },
            });
          }
        });
    },
  },
};
</script>

<style scoped>
/* Contenedor principal de la página con márgenes y gris elegante */
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: rgb(255, 255, 255); /* Blanco */
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
  background-color: #e74c3c;
  color: #fff;
}

button:hover {
  opacity: 0.8;
}

/* Estilo de la foto */
.producer-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 10%;
}
</style>
