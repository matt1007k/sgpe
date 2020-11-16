<template>
  <div>
    <transition name="slide-fade">
      <div class="modal" v-show="open">
        <div class="modal-content" :style="`width:${width ? width : '500px'}`">
          <div class="close" @click="$emit('close', false)">
            <i class="material-icons">close</i>
          </div>
          <slot />
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    open: {
      type: Boolean,
      required: true
    },
    width: {
      type: String,
      default: "500px"
    }
  }
};
</script>