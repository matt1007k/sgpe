<template>
  <div class="search-input">
    <i class="material-icons left icon">search</i>
    <input
      type="search"
      class="input border-none"
      :value="value"
      v-bind="$attrs"
      v-on="inputListeners"
    />
    <div v-if="help" class="help-text">{{ help }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: ["value", "help"],
  computed: {
    inputListeners() {
      var vm = this;
      return Object.assign({}, this.$listeners, {
        input: function(event) {
          vm.$emit("input", event.target.value);
        }
      });
    }
  }
};
</script>