<template>
  <li class="dropdown__container">
    <a class="cursor-pointer" @click="open = !open">
      <i class="material-icons-two-tone icon text-invalid">verified_user</i>
      <span class="name">{{ user.name }}</span>
      <i class="material-icons-two-tone icon transition" :class="{ 'rotate-180': open }">expand_more</i>
    </a>

    <dropdown :open="open">
      <div class="dropdown__head">
        <h4>DNI {{ user.dni }}</h4>
        <show-user-status :status="user.status" />
      </div>
      <div class="divider-x"></div>
      <ul class="dropdown__menu">
        <li>
          <a href="/profile">
            <i class="material-icons">face</i>
            <span>Perfil</span>
          </a>
        </li>
        <li>
          <a @click.prevent="logout">
            <i class="material-icons">exit_to_app</i>
            <span>Salir</span>
          </a>
        </li>
      </ul>
    </dropdown>
  </li>
</template>

<script>
import Dropdown from "../Dropdown";
import ShowUserStatus from "./ShowUserStatus";
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  components: { Dropdown, ShowUserStatus },
  data: () => ({
    open: false
  }),
  methods: {
    logout() {
      axios
        .post("/logout")
        .then(res => (location.href = "/"))
        .catch(err => console.log(err));
    }
  }
};
</script>

<style lang="scss" scoped></style>
