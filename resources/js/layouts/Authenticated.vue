<script setup>
import { useTemplateStore } from "@/stores/template";
import { usePage } from "@inertiajs/vue3";

import BaseLayout from "@/layouts/BaseLayout.vue";
import BaseNavigation from "@/components/BaseNavigation.vue";

// Main store
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

// DEBUG
console.log("Usuario autenticado:", user);
console.log("Rol del usuario:", role);

// Función para construir el menú dinámicamente
function getSidebarItems(role) {
  const baseItems = [
    {
      name: "Dashboard",
      to: "/dashboard",
      icon: "fa fa-rocket",
    },
    {
      name: "Account",
      heading: true,
    },
    {
      name: "Profile",
      to: "/profile",
      icon: "fa fa-user-circle",
    },
  ];

  const footerItems = [
    {
      name: "More",
      heading: true,
    },
    {
      name: "Landing",
      to: "/",
      icon: "fa fa-arrow-left",
    },
  ];

  const maintenanceForAll = [
    {
      name: "Mantenimiento",
      heading: true,
    },
    {
      name: "Characters",
      to: "/characters",
      icon: "fa fa-user-circle",
    },
  ];

  const extraMaintenance = [
    {
      name: "Actores",
      to: "/actoresRuta",
      icon: "fa fa-user-circle",
    },
    {
      name: "Productoras",
      to: "/productoras",
      icon: "fa fa-user-circle",
    },
    {
      name: "Obras",
      to: "/obras",
      icon: "fa fa-user-circle",
    },
    {
      name: "Staff de Soporte",
      to: "/staff-soporte",
      icon: "fa fa-user-circle",
    },
  ];

  if (role === "admin" || role === "operator") {
    return [
      ...baseItems,
      ...maintenanceForAll,
      ...extraMaintenance,
      ...footerItems,
    ];
  }

  // checker
  return [...baseItems, ...maintenanceForAll, ...footerItems];
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
      &copy; {{ store.app.copyright }}
    </template>

    <slot />
  </BaseLayout>
</template>
