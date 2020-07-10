<template>
  <div>
    <template v-if="status == 'verified'">
      <div class="badge badge-primary">Verificado</div>
    </template>
    <template v-else-if="status == 'unverified'">
      <div class="badge badge-danger">Sin verificar</div>
    </template>
  </div>
</template>

<script>
export default {
  props: ["status"]
};
</script>