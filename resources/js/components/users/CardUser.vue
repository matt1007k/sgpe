<template>
  <div class="mb-1 card grid">
    <div class="cols-4 sm:cols-6 md:cols-4 text-left">
      <h4>{{ user.name }}</h4>
      <p class="text-light-blue">DNI {{ user.dni }}</p>
    </div>
    <div class="cols-4 sm:cols-2 md:cols-2 align-self-center">
      <show-user-status :status="user.status" />
    </div>
    <div class="cols-4 sm:cols-5 md:cols-3 align-self-center">
      <p class="text-light-blue">Fecha de registro {{ user.created_at }}</p>
    </div>
    <div class="cols-4 sm:cols-3 md:cols-3 align-self-start">
      <div class="mx-4 actions flex justity-between">
        <btn-delete :id="id" resource="users"></btn-delete>

        <a :href="`users/${id}/edit`" class="action tooltip">
          <i class="material-icons-two-tone">edit</i>
          <span>Editar</span>
        </a>

        <btn-view-user :id="id" :user="user" />
      </div>
    </div>
  </div>
</template>

<script>
import ShowUserStatus from "./ShowUserStatus";
export default {
  components: { ShowUserStatus },
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
};
</script>
