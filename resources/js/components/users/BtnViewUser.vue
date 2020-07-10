<template>
  <div>
    <a class="action tooltip" @click="open = true">
      <i class="material-icons-two-tone">preview</i>
      <span>Ver Detalle</span>
    </a>
    <modal-left :open="open" @close="isClose => open = isClose">
      <div class="card">
        <div class="header flex flex-col align-center justify-center">
          <div class="avatar avatar-default avatar-xl bg-white">
            <i class="material-icons">person</i>
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
              <i class="material-icons-two-tone">card_membership</i>
            </span>
            <span class="ml-2">
              <span class="headline">{{ user.dni }}</span>
              <p class="text-light-blue text-sm">Códido Modular</p>
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
          <a :href="`/users/${user.id}/edit`">Verificar usuario</a>
        </div>
        <div class="mt-4 flex justity-end">
          <a :href="`/users/${user.id}/edit`" class="btn btn-outline-danger">Eliminar</a>
          <a :href="`/users/${user.id}/edit`" class="ml-2 btn btn-primary">Editar</a>
        </div>
      </div>
    </modal-left>
  </div>
</template>

<script>
import ShowUserStatus from "./ShowUserStatus.vue";
export default {
  components: { ShowUserStatus },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      open: false
    };
  }
};
</script>

<style lang="scss" scoped>
</style>