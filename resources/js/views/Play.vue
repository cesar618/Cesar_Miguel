<template>
  <div class="py-5" style="background-color: #fff7fa">
    <div class="container">
      <!-- Tarjeta para el formulario -->
      <div class="card p-4 mb-5 shadow-sm">
        <h4 class="mb-4">
          {{ editingPlay ? "Edit Play" : "Create Play" }}
        </h4>
        <form @submit.prevent="submitPlay">
          <!-- Campo Nombre -->
          <div class="mb-3">
            <label for="name" class="form-label text-white">Name</label>
            <input
              type="text"
              v-model="form.name"
              id="name"
              class="form-control"
              required
            />
          </div>

          <!-- Campo Fecha -->
          <div class="mb-3">
            <label for="date" class="form-label text-white">Date</label>
            <div class="input-group">
              <input
                type="date"
                v-model="form.date"
                id="date"
                class="form-control"
                required
              />
            </div>
          </div>

          <!-- Campo Ubicación -->
          <div class="mb-3">
            <label for="location" class="form-label text-white">Location</label>
            <input
              type="text"
              v-model="form.location"
              id="location"
              class="form-control"
              required
            />
          </div>

          <!-- Campo Productor -->
          <div class="mb-3">
            <label for="producer_id" class="form-label text-white"
              >Producer</label
            >
            <select
              v-model="form.producer_id"
              id="producer_id"
              class="form-control"
              required
            >
              <option
                v-for="producer in producers"
                :key="producer.id"
                :value="producer.id"
              >
                {{ producer.name }}
              </option>
            </select>
          </div>

          <!-- Agregar Personajes -->
          <div class="mb-3">
            <label for="characters" class="form-label text-white"
              >Add Characters</label
            >
            <select
              multiple
              v-model="form.characters"
              id="characters"
              class="form-control"
            >
              <option
                v-for="character in characters"
                :key="character.id"
                :value="character.id"
              >
                {{ character.name }}
              </option>
            </select>
          </div>

          <!-- Botón Crear/Actualizar -->
          <button
            type="submit"
            class="btn"
            :class="editingPlay ? 'btn-primary' : 'btn-success'"
          >
            {{ editingPlay ? "Update" : "Create" }}
          </button>
          <button
            v-if="editingPlay"
            @click="cancelEdit"
            type="button"
            class="btn btn-secondary ms-2"
          >
            Cancel
          </button>
        </form>
      </div>

      <!-- Tarjeta para la tabla de obras -->
      <div class="card p-4 shadow-sm" v-if="plays.length">
        <h4 class="mb-4">Plays</h4>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th scope="col" style="width: 60px">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="play in plays" :key="play.id">
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
                    @click="editPlay(play)"
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
      <div v-else class="card p-4 shadow-sm">
        <h4 class="mb-0 text-muted">No plays created yet.</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    plays: Array,
    producers: Array,
    characters: Array,
  },
  mounted() {
    // Verifica en la consola si los personajes están llegando correctamente
    console.log(this.characters);
  },
  data() {
    return {
      form: {
        name: "",
        date: "",
        location: "",
        producer_id: null,
        characters: [],
        image: null,
      },
      editingPlay: null,
    };
  },
  methods: {
    handleImageUpload(event) {
      this.form.image = event.target.files[0];
    },
    async submitPlay() {
      const formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("date", this.form.date);
      formData.append("location", this.form.location);
      formData.append("producer_id", this.form.producer_id);
      formData.append("characters", JSON.stringify(this.form.characters));
      if (this.form.image) {
        formData.append("image", this.form.image);
      }

      if (this.editingPlay) {
        formData.append("_method", "PUT");
        await this.$inertia.post(`/plays/${this.editingPlay.id}`, formData);
      } else {
        await this.$inertia.post("/plays", formData);
      }
      this.resetForm();
    },
    editPlay(play) {
      this.form.name = play.name;
      this.form.date = play.date;
      this.form.location = play.location;
      this.form.producer_id = play.producer_id;
      this.form.characters = play.characters.map((character) => character.id);
      this.editingPlay = play;
      window.scrollTo({ top: 0, behavior: "smooth" });
    },
    async deletePlay(playId) {
      if (confirm("Are you sure you want to delete this play?")) {
        await this.$inertia.delete(`/plays/${playId}`);
      }
    },
    cancelEdit() {
      this.resetForm();
    },
    resetForm() {
      this.form.name = "";
      this.form.date = "";
      this.form.location = "";
      this.form.producer_id = null;
      this.form.characters = [];
      this.form.image = null;
      this.editingPlay = null;
    },
  },
};
</script>

<style scoped>
/* Contenedor de la imagen y otros detalles */
.note-box {
  background: #f8f9fa;
  border: 1px solid #ddd;
  padding: 8px;
  border-radius: 5px;
  margin-top: 5px;
  font-size: 0.9rem;
  color: #333;
}
</style>
