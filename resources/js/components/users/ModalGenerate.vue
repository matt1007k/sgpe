<template>
  <div>
    <a class="cursor-pointer" @click.prevent="open = true">Generar o cambiar contraseña</a>
    <modal :open="open" @close="isClose => open = isClose">
      <div class="card">
        <h3 class="mb-1">Generar o cambiar contraseña</h3>
        <p class="text-light-blue">Genera una contraseña de manera aleatoria o ingresa una propia.</p>
        <slot />
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "../Modal";
export default {
  components: { Modal },
  data: () => ({
    open: false
  })
};
</script>