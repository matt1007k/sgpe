<template>
  <div class="flex dropdown__container align-center text-light-blue">
    Ordenar por:
    <a @click="open = !open" class="cursor-pointer">
      <i class="ml-1 material-icons-two-tone">sort</i>
    </a>
    <dropdown :open="open">
      <ul class="dropdown__menu">
        <li
          v-for="(sort, index) in list"
          :key="index"
          @click="$emit('onOrder', sort.order); open = false"
          class="justity-between"
          :class="{ 'active': sortSelected === sort.order }"
        >
          {{ sort.title }}
          <i class="material-icons">{{ sort.icon }}</i>
        </li>
      </ul>
    </dropdown>
  </div>
</template>

<script>
import Dropdown from "./Dropdown";
export default {
  props: {
    list: {
      type: Array,
      required: true
    },
    sortSelected: {
      type: String
    }
  },
  components: { Dropdown },
  data: () => ({
    open: false
  })
};
</script>
