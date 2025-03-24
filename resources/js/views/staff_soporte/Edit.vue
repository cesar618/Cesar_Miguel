<template>
  <div class="page-container">
    <div class="header">
      <h1 class="form-title">Editar Personal de Soporte</h1>
    </div>

    <!-- Formulario de edición -->
    <div class="form-container">
      <form @submit.prevent="submit" class="elegant-form">
        <div class="form-group">
          <label for="first_name">Nombre</label>
          <input
            type="text"
            v-model="form.first_name"
            id="first_name"
            placeholder="Ingresa el nombre"
            required
          />
        </div>
        <div class="form-group">
          <label for="last_name">Apellido</label>
          <input
            type="text"
            v-model="form.last_name"
            id="last_name"
            placeholder="Ingresa el apellido"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            v-model="form.email"
            id="email"
            placeholder="Ingresa el email"
            required
          />
        </div>
        <div class="form-group">
          <label for="phone">Teléfono</label>
          <input
            type="text"
            v-model="form.phone"
            id="phone"
            placeholder="Ingresa el teléfono"
          />
        </div>
        <div class="form-group">
          <label for="city">Ciudad</label>
          <input
            type="text"
            v-model="form.city"
            id="city"
            placeholder="Ingresa la ciudad"
          />
        </div>
        <div class="form-group">
          <label for="has_car">Tiene auto</label>
          <label class="switch">
            <input type="checkbox" v-model="form.has_car" id="has_car" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="form-group">
          <label for="can_drive">Sabe conducir</label>
          <label class="switch">
            <input type="checkbox" v-model="form.can_drive" id="can_drive" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="form-group">
          <label for="active">Activo</label>
          <label class="switch">
            <input type="checkbox" v-model="form.active" id="active" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="form-group">
          <label for="notes">Notas</label>
          <textarea
            v-model="form.notes"
            id="notes"
            placeholder="Ingresa las notas"
            rows="3"
          ></textarea>
        </div>
        <div class="form-group button-wrapper">
          <button type="submit" class="btn btn-success">Actualizar</button>
          <Link href="/staff-soporte" class="btn btn-secondary">Cancelar</Link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    staff: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      form: {
        first_name: this.staff.first_name,
        last_name: this.staff.last_name,
        email: this.staff.email,
        phone: this.staff.phone,
        city: this.staff.city,
        has_car: Boolean(this.staff.has_car),
        can_drive: Boolean(this.staff.can_drive),
        active: Boolean(this.staff.active),
        notes: this.staff.notes,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.put(`/staff-soporte/${this.staff.id}`, this.form);
    },
  },
};
</script>

<style scoped>
.page-container {
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(231, 40, 40, 0.1);
  min-height: 100vh;
}

.header {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 30px;
}

.form-title {
  font-size: 2rem;
  color: #333;
  font-weight: 600;
}

.form-container {
  padding: 30px;
  border-bottom: 1px solid #ddd;
}

.elegant-form {
  width: 100%;
}

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
input[type="email"],
textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  color: #333;
  background-color: #fff;
  transition:
    border-color 0.3s ease,
    box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
  border-color: #4caf50;
  box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
  outline: none;
}

.button-wrapper {
  margin-top: 20px;
}

.btn {
  display: block;
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition:
    background-color 0.3s ease,
    transform 0.2s ease;
}

.btn-success {
  background-color: #4caf50;
  color: #fff;
}

.btn:hover {
  background-color: #5f7dc8;
  transform: translateY(-2px);
}

.btn-secondary {
  margin-top: 10px;
  background-color: #6c757d;
  color: #fff;
  text-align: center;
  padding: 12px;
  border-radius: 8px;
  text-decoration: none;
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
  cursor: pointer;
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
