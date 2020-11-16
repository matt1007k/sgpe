<template>
  <div class="group-input">
    <label :for="id">{{ label }}</label>
    <textarea
      class="input"
      :class="{ 'is-invalid': error }"
      :id="id"
      :value="value"
      v-on="textAreaListeners"
      :style="`height: ${height ? height : '200px'}`"
    ></textarea>
    <div v-if="error" class="text-invalid">{{ error[0] }}</div>
    <div v-if="help" class="text-help">{{ help }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: ["label", "id", "value", "help", "error", "height"],
  computed: {
    textAreaListeners() {
      var vm = this;
      return Object.assign({}, this.$listeners, {
        input(event) {
          vm.$emit("input", event.target.value);
        }
      });
    }
  }
};
</script>