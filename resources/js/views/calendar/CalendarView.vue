<script setup>
import { ref, reactive, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

// Layout y componentes
import BaseLayout from "@/layouts/BaseLayout.vue";
import BaseNavigation from "@/components/BaseNavigation.vue";
import BasePageHeading from "@/components/BasePageHeading.vue";
import { useTemplateStore } from "@/stores/template";

// FullCalendar
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

// Configuración del layout
const store = useTemplateStore();
store.setLayout({
  header: true,
  sidebar: true,
  sideOverlay: true,
  footer: true,
});
store.header({ mode: "fixed" });
store.headerStyle({ mode: "light" });
store.mainContent({ mode: "narrow" });

// Obtener usuario y rol
const page = usePage();
const user = page.props.auth.user;
const role = user?.roles?.[0] ?? null;

console.log("Usuario autenticado:", user);
console.log("Rol del usuario:", role);

// Menú dinámico
function getSidebarItems(role) {
  const baseItems = [
    { name: "Dashboard", to: "/dashboard", icon: "fa fa-rocket" },
    { name: "Account", heading: true },
    { name: "Profile", to: "/profile", icon: "fa fa-user-circle" },
  ];
  const footerItems = [
    { name: "More", heading: true },
    { name: "Landing", to: "/", icon: "fa fa-arrow-left" },
  ];
  const maintenanceForAll = [
    { name: "Mantenimiento", heading: true },
    { name: "Characters", to: "/characters", icon: "fa fa-user-circle" },
  ];
  const extraMaintenance = [
    { name: "Actores", to: "/actoresRuta", icon: "fa fa-user-circle" },
    { name: "Productoras", to: "/productoras", icon: "fa fa-user-circle" },
    { name: "Obras", to: "/obras", icon: "fa fa-user-circle" },
    { name: "Eventos", to: "/eventos", icon: "fa fa-user-circle" },
    { name: "Locaciones", to: "/location", icon: "fa fa-user-circle" },
    { name: "Calendario", to: "/calendar", icon: "fa fa-user-circle" },
    { name: "Staff de Soporte", to: "/staff-soporte", icon: "fa fa-user-circle" },
  ];

  if (role === "admin" || role === "operator") {
    return [...baseItems, ...maintenanceForAll, ...extraMaintenance, ...footerItems];
  }
  return [...baseItems, ...maintenanceForAll, ...footerItems];
}

// Variables para el calendario
const fullCalendar = ref(null);
const inputAddEvent = ref(null);
const calendarNewEvent = ref("");
const calendarNewEvents = reactive([
  { name: "Codename X", color: "info" },
  { name: "Weekend Adventure", color: "success" },
  { name: "Project Mars", color: "info" },
]);

const calendarOptions = reactive({
  events: [],
  plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
  firstDay: 1,
  editable: true,
  droppable: true,
  headerToolbar: {
    left: "title",
    right: "prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek",
  },
  dateClick: handleDateClick,
  eventDrop: handleEventDrop,
  eventReceive: handleExternalDrop,
  eventClick: handleEventClick, // Para mostrar detalles
});

// Cargar eventos desde el backend
async function loadEvents() {
  const response = await axios.get("/calendar/events");
  calendarOptions.events = response.data;
}

onMounted(async () => {
  await loadEvents();

  new Draggable(document.getElementById("js-events"), {
    itemSelector: ".js-event",
    eventData(eventEl) {
      return {
        title: eventEl.textContent,
        backgroundColor: getComputedStyle(eventEl).color,
        borderColor: getComputedStyle(eventEl).color,
      };
    },
  });
});

// Manejar clic en una fecha para agregar evento
function handleDateClick(arg) {
  const name = prompt("Enter event name:");
  if (name) {
    axios
      .post("/calendar/events", {
        name,
        date: arg.dateStr.split("T")[0], // Solo la fecha
        start_time: arg.dateStr.includes("T") ? arg.dateStr.split("T")[1].slice(0, 5) : null,
      })
      .then(() => loadEvents())
      .catch((error) => console.error("Error adding event:", error));
  }
}

// Manejar arrastre de eventos
function handleEventDrop(eventDropInfo) {
  const event = eventDropInfo.event;
  const startDateTime = event.start.toISOString();
  const endDateTime = event.end ? event.end.toISOString() : null;

  axios
    .put(`/calendar/events/${event.id}`, {
      date: startDateTime.split("T")[0],
      start_time: startDateTime.split("T")[1]?.slice(0, 5) || null,
      end_time: endDateTime ? endDateTime.split("T")[1]?.slice(0, 5) : null,
    })
    .then(() => console.log("Event updated"))
    .catch((error) => console.error("Error updating event:", error));
}

// Manejar eventos externos soltados
function handleExternalDrop(info) {
  const event = info.event;
  axios
    .post("/calendar/events", {
      name: event.title,
      date: event.start.toISOString().split("T")[0],
      start_time: event.start.toISOString().split("T")[1]?.slice(0, 5) || null,
    })
    .then(() => loadEvents())
    .catch((error) => console.error("Error adding external event:", error));
}

// Mostrar detalles del evento al hacer clic
function handleEventClick(info) {
  const event = info.event;
  const props = event.extendedProps;
  alert(
    `Event: ${event.title}\n` +
    `Date: ${event.start.toLocaleDateString()}\n` +
    `Time: ${event.start.toLocaleTimeString()} - ${event.end ? event.end.toLocaleTimeString() : "N/A"}\n` +
    `Description: ${props.description || "N/A"}\n` +
    `Play: ${props.play || "N/A"}\n` +
    `Location: ${props.location || "N/A"}\n` +
    `Info URL: ${props.url_info || "N/A"}\n` +
    `Tickets URL: ${props.url_tickets || "N/A"}`
  );
}

// Agregar nuevo evento desde el formulario
function addNewEvent() {
  if (calendarNewEvent.value) {
    calendarNewEvents.unshift({
      name: calendarNewEvent.value,
      color: "info",
    });
    calendarNewEvent.value = "";
    inputAddEvent.value.focus();
  }
}
</script>

<template>
  <BaseLayout>
    <!-- Side Overlay Header -->
    <template #side-overlay-header>
      <a class="img-link me-1" href="javascript:void(0)">
        <img
          class="img-avatar img-avatar32"
          :src="$page.props.auth.user.gravatar"
          alt="User Avatar"
        />
      </a>
      <div class="ms-2">
        <Link href="/profile" class="text-dark fw-semibold fs-sm">
          {{ $page.props.auth.user.name }}
        </Link>
      </div>
    </template>

    <!-- Side Overlay Content -->
    <template #side-overlay-content>
      <div class="content-side">
        <p class="fs-sm">Side Overlay content..</p>
      </div>
    </template>

    <!-- Sidebar Content -->
    <template #sidebar-content>
      <div class="content-side">
        <BaseNavigation :nodes="getSidebarItems(role)" />
      </div>
    </template>

    <!-- Header Content Left -->
    <template #header-content-left>
      <button
        type="button"
        class="btn btn-sm btn-alt-secondary me-2"
        @click="store.sidebar({ mode: 'toggle' })"
      >
        <i class="fa fa-fw fa-bars"></i>
      </button>
    </template>

    <!-- Header Content Right -->
    <template #header-content-right>
      <div class="dropdown d-inline-block ms-2">
        <button
          type="button"
          class="btn btn-sm btn-alt-secondary d-flex align-items-center"
          id="page-header-user-dropdown"
          data-bs-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <img
            class="rounded-circle"
            :src="$page.props.auth.user.gravatar"
            alt="User Avatar"
            style="width: 21px"
          />
          <span class="d-none d-sm-inline-block ms-2">
            {{ $page.props.auth.user.name.split(" ")[0] }}
          </span>
          <i
            class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"
          ></i>
        </button>
        <div
          class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
          aria-labelledby="page-header-user-dropdown"
        >
          <div class="p-2">
            <Link
              href="/profile"
              class="dropdown-item d-flex align-items-center justify-content-between"
            >
              <span class="fs-sm fw-medium">Profile</span>
            </Link>
            <Link
              href="/logout"
              method="post"
              class="dropdown-item d-flex align-items-center justify-content-between"
              as="button"
            >
              <span class="fs-sm fw-medium">Log Out</span>
            </Link>
          </div>
        </div>
      </div>
      <button
        type="button"
        class="btn btn-sm btn-alt-secondary ms-2"
        @click="store.sideOverlay({ mode: 'toggle' })"
      >
        <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
      </button>
    </template>

    <!-- Footer Content Left -->
    <template #footer-content-left>
      <strong>{{ store.app.version }}</strong>
      © {{ store.app.copyright }}
    </template>

    <!-- Page Content -->
    <BasePageHeading title="Calendar" subtitle="Manage your theater events efficiently.">
      <template #extra>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Plugins</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Calendar</li>
          </ol>
        </nav>
      </template>
    </BasePageHeading>

    <div class="content">
      <BaseBlock>
        <div class="row items-push">
          <div class="col-md-8 col-lg-7 col-xl-9">
            <FullCalendar ref="fullCalendar" :options="calendarOptions" />
          </div>
          <div class="col-md-4 col-lg-5 col-xl-3">
            <form class="push" @submit.prevent="addNewEvent">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Add Event.."
                  v-model="calendarNewEvent"
                  ref="inputAddEvent"
                />
                <span class="input-group-text">
                  <i class="fa fa-fw fa-plus-circle"></i>
                </span>
              </div>
            </form>
            <ul id="js-events" class="list list-events">
              <li v-for="(event, index) in calendarNewEvents" :key="`events-${index}`">
                <div
                  class="js-event p-2 fs-sm fw-medium rounded"
                  :class="`bg-${event.color}-light text-${event.color}`"
                >
                  {{ event.name }}
                </div>
              </li>
            </ul>
            <div class="text-center">
              <p class="fs-sm text-muted">
                <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
              </p>
            </div>
          </div>
        </div>
      </BaseBlock>
    </div>
  </BaseLayout>
</template>

<style lang="scss">
@import "@/../scss/vendor/fullcalendar";
</style>