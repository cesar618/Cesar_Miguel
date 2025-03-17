<template>
  <div class="py-5" style="background-color: #fff7fa">
    <div class="container">
      <!-- Tarjeta para el formulario -->
      <div
        class="card p-4 mb-5 shadow-sm"
        style="
          background-color: white;
          color: black;
          box-shadow: 6px 6px 20px rgba(0, 0, 0, 5);
          border: none;
        "
      >
        <h4 class="mb-4 text-black">
          {{ editingPlay ? "Edit Play" : "Create Play" }}
        </h4>
        <form @submit.prevent="submitPlay">
          <!-- Campo Nombre -->
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
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
            <label for="date" class="form-label">Date</label>
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
            <label for="location" class="form-label">Location</label>
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
            <label for="producer_id" class="form-label">Producer</label>
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
            <label for="characters" class="form-label">Add Characters</label>
            <!-- Checkbox para seleccionar/desmarcar todos -->
            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                id="selectAll"
                v-model="selectAll"
                @change="toggleSelectAll"
              />
              <label class="form-check-label" for="selectAll">
                Select All
              </label>
            </div>

            <div class="d-flex flex-wrap">
              <!-- Muestra cada personaje con un cuadro de selección -->
              <div
                v-for="character in characters"
                :key="character.id"
                class="character-card p-2 mb-3"
                style="
                  border: 1px solid #ccc;
                  border-radius: 35px;
                  margin-right: 10px;
                "
              >
                <img
                  :src="
                    character.image
                      ? `/storage/${character.image}`
                      : '/assets/media/photos/imagen_usuario.jpg'
                  "
                  alt="Avatar"
                  class="rounded-circle"
                  style="
                    width: 40px;
                    height: 40px;
                    object-fit: cover;
                    margin-bottom: 5px;
                  "
                />
                <p class="mb-1">{{ character.name }}</p>
                <!-- Cuadro de selección -->
                <input
                  type="checkbox"
                  :id="`character-${character.id}`"
                  v-model="form.characters"
                  :value="character"
                  class="form-check-input"
                />
              </div>
            </div>
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
    </div>
  </div>
</template>

<script>
export default {
  props: {
    play: {
      type: Object,
      default: null,
    },
    producers: Array,
    characters: Array,
  },
  data() {
    return {
      form: {
        name: this.play ? this.play.name : "",
        date: this.play ? this.play.date : "",
        location: this.play ? this.play.location : "",
        producer_id: this.play ? this.play.producer_id : null,
        characters: this.play ? this.play.characters : [],
      },
      editingPlay: !!this.play,
      selectAll: false, // Variable para el checkbox "Seleccionar todos"
    };
  },
  methods: {
    async submitPlay() {
      const formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("date", this.form.date);
      formData.append("location", this.form.location);
      formData.append("producer_id", this.form.producer_id);
      formData.append(
        "characters",
        JSON.stringify(this.form.characters.map((c) => c.id)),
      );

      if (this.editingPlay) {
        formData.append("_method", "PUT");
        await this.$inertia.post(`/plays/${this.play.id}`, formData);
      } else {
        await this.$inertia.post("/plays", formData);
      }
      this.goBack();
    },
    cancelEdit() {
      this.goBack();
    },
    goBack() {
      this.$inertia.visit("/plays");
    },
    toggleSelectAll() {
      if (this.selectAll) {
        // Selecciona todos los personajes
        this.form.characters = [...this.characters];
      } else {
        // Deselecciona todos
        this.form.characters = [];
      }
    },
  },
};
</script>

<style scoped>
/* Estilo para las tarjetas de personajes */
.character-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100px;
  text-align: center;
  background-color: white;
  border-radius: 5px;
  padding: 10px;
  transition:
    background-color 0.3s ease,
    box-shadow 0.3s ease;
}
input.form-control {
  background-color: white;
  color: rgb(9, 9, 9); /* Si también deseas que el texto sea negro */
  border: 1px solid #ccc; /* Borde para los campos */
}

/* Si deseas cambiar también el color de fondo de los campos select */
select.form-control {
  background-color: white;
  color: rgb(248, 247, 247);
  border: 1px solid #ccc;
}
input.form-control:focus,
select.form-control:focus {
  background-color: white; /* Mantener el color de fondo */
  color: rgb(9, 9, 9); /* Mantener el color del texto */
  border-color: #79e77d; /* Cambio de color del borde al enfocar */
  outline: none; /* Elimina el borde predeterminado del navegador */
}
.character-card:hover {
  background-color: #4ce292; /* Fondo azul claro */
  box-shadow: 0px 4px 10px rgba(0, 0, 6, 0.3); /* Sombra azul */
}
</style>
