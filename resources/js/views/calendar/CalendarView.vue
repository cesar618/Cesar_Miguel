<script setup>
import { ref, reactive, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

// FullCalendar
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

// Obtener usuario y rol
const page = usePage();
const user = page.props.auth.user;
const role = user?.roles?.[0] ?? null;

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
  eventClick: handleEventClick,
});

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

function handleDateClick(arg) {
  const name = prompt("Enter event name:");
  if (name) {
    axios
      .post("/calendar/events", {
        name,
        date: arg.dateStr.split("T")[0],
        start_time: arg.dateStr.includes("T")
          ? arg.dateStr.split("T")[1].slice(0, 5)
          : null,
      })
      .then(() => loadEvents())
      .catch((error) => console.error("Error adding event:", error));
  }
}

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
      `Tickets URL: ${props.url_tickets || "N/A"}`,
  );
}

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
  <div class="page-container">
    <h1>Calendario de eventos</h1>

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
              placeholder="Añadir evento..."
              v-model="calendarNewEvent"
              ref="inputAddEvent"
            />
            <span class="input-group-text">
              <i class="fa fa-fw fa-plus-circle"></i>
            </span>
          </div>
        </form>
        <ul id="js-events" class="list list-events">
          <li
            v-for="(event, index) in calendarNewEvents"
            :key="`events-${index}`"
          >
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
            <i class="fa fa-arrows-alt"></i> Arrastra y suelta eventos en el
            calendario
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@import "@/../scss/vendor/fullcalendar";

.page-container {
  padding: 20px;
}

h1 {
  margin-bottom: 20px;
}
</style>
