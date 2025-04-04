<template>
  <Head title="Profile" />

  <!-- Hero -->
  <BaseBackground image="/assets/media/photos/photo33@2x.jpg">
    <div class="bg-primary-dark-op">
      <div class="content content-full text-center">
        <div class="my-3">
          <img
            class="img-avatar img-avatar-thumb"
            :src="$page.props.auth.user.gravatar"
            alt="User Avatar"
          />
        </div>
        <h1 class="h2 text-white mb-0">{{ $page.props.auth.user.name }}</h1>
        <!-- Mostrar roles: se asume que $page.props.auth.user.roles es un arreglo -->
        <p class="text-white-75 mb-3">
          Roll: {{ $page.props.auth.user.roles.join(", ") }}
        </p>
        <h2 class="h4 fw-normal text-white-75">Edit your profile</h2>
      </div>
    </div>
  </BaseBackground>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content content-boxed">
    <BaseBlock title="Profile Information">
      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">
            Your account’s vital info. Your username will be publicly visible.
          </p>
        </div>
        <div class="col-lg-8 col-xl-5">
          <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
          />
        </div>
      </div>
    </BaseBlock>

    <BaseBlock title="Update Password">
      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">
            Ensure your account is using a long, random password to stay secure.
          </p>
        </div>
        <div class="col-lg-8 col-xl-5">
          <UpdatePasswordForm />
        </div>
      </div>
    </BaseBlock>

    <BaseBlock title="Delete Account">
      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">Permanently delete your account.</p>
        </div>
        <div class="col-lg-8 col-xl-5">
          <DeleteUserForm />
        </div>
      </div>
    </BaseBlock>
  </div>
  <!-- END Page Content -->
</template>

<script setup>
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});
</script>
