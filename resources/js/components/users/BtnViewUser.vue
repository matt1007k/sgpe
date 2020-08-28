<template>
  <div>
    <a class="action tooltip" @click="open = true">
      <i class="material-icons-two-tone">preview</i>
      <span>Ver Detalle</span>
    </a>
    <modal-left :open="open" @close="isClose => open = isClose">
      <div class="card">
        <div class="header bg-dark profile flex flex-col align-center justify-center">
          <div class="avatar avatar-default avatar-xl bg-white">
            <div class="avatar-image">
              <img
                src="https://e7.pngegg.com/pngimages/7/618/png-clipart-man-illustration-avatar-icon-fashion-men-avatar-face-fashion-girl.png"
                alt="Avatar"
              />
            </div>
          </div>
          <h3 class="mt-2 mb-1 text-white">{{ user.name }}</h3>
          <show-user-status :status="user.status" />
        </div>
        <div class="mt-6 flex flex-wrap flex-col">
          <div class="flex">
            <span
              class="badge badge-primary badge-sm flex justify-center align-center"
              style="height: 32px; width: 32px"
            >
              <i class="material-icons-two-tone">credit_card</i>
            </span>
            <span class="ml-2">
              <span class="headline">{{ user.dni }}</span>
              <p class="text-light-blue text-sm">DNI</p>
            </span>
          </div>

          <div class="flex mt-2">
            <span
              class="badge badge-primary badge-sm flex justify-center align-center"
              style="height: 32px; width: 32px"
            >
              <i class="material-icons-two-tone">smartphone</i>
            </span>
            <span class="ml-2">
              <span class="headline">{{ user.phone }}</span>
              <p class="text-light-blue text-sm">Teléfono o Celular</p>
            </span>
          </div>
          <div class="flex mt-2">
            <span
              class="badge badge-primary badge-sm flex justify-center align-center"
              style="height: 32px; width: 32px"
            >
              <i class="material-icons-two-tone">email</i>
            </span>
            <span class="ml-2">
              <span class="headline">{{ user.email }}</span>
              <p class="text-light-blue text-sm">Correo Electrónico</p>
            </span>
          </div>
        </div>
        <div class="mt-4">
          <a :href="`/users/${id}/edit`">Verificar usuario</a>
        </div>
        <div class="mt-4 flex justity-end">
          <!-- <BtnDeleteOutline :id="id" resource="users" /> -->
          <a :href="`/users/${id}/edit`" class="ml-2 btn btn-primary">Editar</a>
        </div>
      </div>
    </modal-left>
  </div>
</template>

<script>
import ShowUserStatus from "./ShowUserStatus.vue";
import BtnDeleteOutline from "./../BtnDeleteOutline.vue";
export default {
  components: { ShowUserStatus, BtnDeleteOutline },
  props: {
    id: {
      type: String,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      open: false,
    };
  },
};
</script>

<style lang="scss" scoped>
</style>