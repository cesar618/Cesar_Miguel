import Swal from "sweetalert2";

export default {
  install(app) {
    // Esto agrega SweetAlert2 a las propiedades globales de Vue
    app.config.globalProperties.$swal = Swal;
  },
};
