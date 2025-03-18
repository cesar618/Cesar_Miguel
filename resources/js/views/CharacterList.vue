<template>
  <div class="page-container">
    <h1>Personajes</h1>
    <div class="actions">
      <button class="btn-add" @click="createCharacter">Alta Personaje</button>
    </div>

    <!-- Buscador -->
    <div class="search-container">
      <div class="search-group">
        <label for="search-name">Nombre</label>
        <input type="text" v-model="search.name" id="search-name" placeholder="Buscar por nombre" />
      </div>
      <div class="search-group">
        <label for="search-work">Obra</label>
        <input type="text" v-model="search.work" id="search-work" placeholder="Buscar por obra" />
      </div>
    </div>

    <!-- Tabla -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Obra</th>
            <th>Notas</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(character, index) in filteredCharacters" :key="character.id">
            <td>
              <img
                :src="character.image ? `/storage/${character.image}` : '/path/to/default-Personaje.png'"
                alt="Foto"
                class="character-photo"
              />
            </td>
            <td>{{ character.name }}</td>
            <td>{{ character.work || 'N/A' }}</td>
            <td>{{ character.notes || 'N/A' }}</td>
            <td>
              <button :id="'btn-edit-' + index" class="btn-edit" @click="editCharacter(character.id)">Editar</button>
              <button :id="'btn-delete-' + index" class="btn-delete" @click="deleteCharacter(character.id)">Eliminar</button>
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
    characters: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      search: {
        name: '',
        work: '',
      },
    };
  },
  computed: {
    filteredCharacters() {
      return this.characters.filter(character => {
        return (
          (!this.search.name || 
           character.name.toLowerCase().includes(this.search.name.toLowerCase())) &&
          (!this.search.work || 
           character.work?.toLowerCase().includes(this.search.work.toLowerCase()))
        );
      });
    },
  },
  methods: {
    createCharacter() {
      this.$inertia.visit('/characters/crear');
    },
    editCharacter(characterId) {
      this.$inertia.visit(`/characters/${characterId}/editar`);
    },
    deleteCharacter(characterId) {
      if (confirm('¿Estás seguro de que deseas eliminar este personaje?')) {
        this.$inertia.delete(`/characters/${characterId}`, {
          preserveState: false,
          onError: (errors) => {
            console.error('Error al eliminar el personaje:', errors);
            alert('Hubo un error al eliminar el personaje.');
          },
        });
      }
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
  font-size: 1rem;
  font-weight: 600;
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

/* Estilo del título */
h1 {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
  margin-bottom: 20px;
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
  color: #555;
}

td {
  background-color: #fafafa;
  color: #555;
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

.btn-delete:hover {
  background-color: #c0392b;
  opacity: 0.8;
}

/* Estilo de la foto */
.character-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 5¡10%;
}

/* Responsividad */
@media (max-width: 768px) {
  .page-container {
    margin: 15px;
    padding: 15px;
  }

  h1 {
    font-size: 1.5rem;
  }

  .btn-add {
    padding: 6px 12px;
    font-size: 0.9rem;
  }

  th,
  td {
    padding: 10px;
  }

  .search-container {
    grid-template-columns: 1fr; /* Una columna en pantallas medianas */
  }
}

@media (max-width: 480px) {
  .actions {
    justify-content: flex-start;
    margin-bottom: 15px;
  }

  .btn-add {
    width: 100%;
    margin-top: 10px;
  }

  h1 {
    font-size: 1.25rem;
  }

  .page-container {
    margin: 10px;
    padding: 10px;
  }

  th,
  td {
    padding: 8px;
    font-size: 0.85rem;
  }

  .btn-edit,
  .btn-delete {
    padding: 5px 10px;
    font-size: 0.8rem;
  }

  .search-container {
    grid-template-columns: 1fr; /* Una columna en pantallas pequeñas */
  }
}
</style>