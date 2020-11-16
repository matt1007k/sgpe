<template>
  <div class="flex dropdown__container align-center text-light-blue">
    Ordenar por:
    <a @click="open = !open" class="cursor-pointer">
      <i class="ml-1 material-icons-two-tone">sort</i>
    </a>
    <dropdown :open="open">
      <slot />
    </dropdown>
  </div>
</template>

<script>
import Dropdown from "./Dropdown";
export default {
  components: { Dropdown },
  data: () => ({
    open: false
  })
};
</script>
