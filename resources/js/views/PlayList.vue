<template>
  <div class="py-5" style="background-color: #fff7fa">
    <div class="container">
      <!-- Botón para crear una nueva obra -->
      <div class="mb-4 d-flex justify-content-end">
        <button @click="goToCreate" class="btn btn-success">Dar de alta</button>
      </div>

      <!-- Campo de búsqueda por nombre (justo encima de los personajes) -->
      <div class="mb-4">
        <label for="search" class="form-label text-black"></label>
        <input
          type="text"
          id="search"
          v-model="searchQuery"
          class="form-control"
          placeholder="Busqueda por nombre"
          style="width: 250px"
        />
      </div>

      <!-- Tarjeta con la lista de obras -->
      <div
        class="card p-4 shadow-sm"
        v-if="plays.length"
        style="background-color: white; color: black"
      >
        <h4 class="mb-4">Plays</h4>
        <div class="table-responsive" style="background-color: white">
          <table class="table align-middle" style="background-color: white">
            <thead>
              <tr style="background-color: white">
                <th scope="col" style="width: 60px">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="play in plays"
                :key="play.id"
                style="background-color: white"
              >
                <!-- Columna de imagen -->
                <td>
                  <img
                    :src="
                      play.image
                        ? `/storage/${play.image}`
                        : '/assets/media/photos/default_play_image.jpg'
                    "
                    alt="Play image"
                    class="rounded-circle"
                    style="width: 40px; height: 40px; object-fit: cover"
                  />
                </td>
                <!-- Columna de nombre -->
                <td>{{ play.name }}</td>
                <!-- Columna de estado -->
                <td>{{ play.active ? "Active" : "Inactive" }}</td>
                <!-- Columna de acciones -->
                <td class="text-end">
                  <button
                    @click="deletePlay(play.id)"
                    class="btn btn-outline-danger btn-sm me-2"
                  >
                    Delete
                  </button>
                  <button
                    @click="goToEdit(play.id)"
                    class="btn btn-outline-primary btn-sm"
                  >
                    Edit
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Mensaje cuando no hay obras -->
      <div
        v-else
        class="card p-4 shadow-sm"
        style="background-color: white; color: black"
      >
        <h4 class="mb-0 text-muted">No plays created yet.</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    plays: Array,
  },
  data() {
    return {
      searchQuery: "", // Aquí defines la propiedad searchQuery
    };
  },
  methods: {
    goToCreate() {
      // Redirige al formulario para crear una nueva obra
      this.$inertia.visit("/plays/create");
    },
    goToEdit(playId) {
      // Redirige al formulario para editar la obra
      this.$inertia.visit(`/plays/${playId}/edit`);
    },
    async deletePlay(playId) {
      if (confirm("Are you sure you want to delete this play?")) {
        await this.$inertia.delete(`/plays/${playId}`);
      }
    },
  },
};
</script>

<style scoped>
/* Puedes agregar estilos adicionales aquí si lo necesitas */
</style>
