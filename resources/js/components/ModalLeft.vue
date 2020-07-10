<template>
  <transition name="slide-fade">
    <div class="modal-left" v-show="open" @click="$emit('close', false)">
      <div class="modal-content">
        <div class="close" @click="$emit('close', false)">
          <i class="material-icons">close</i>
        </div>
        <slot />
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    open: {
      default: false,
      type: Boolean,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
</style>