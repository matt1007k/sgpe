<template>
  <div class="group-input">
    <label :for="id">{{ label }}</label>
    <input
      class="input"
      :class="{'is-invalid': error}"
      :id="id"
      :value="value"
      v-bind="$attrs"
      v-on="inputListeners"
    />
    <div class="text-invalid" v-if="error">{{ error[0] }}</div>
    <div v-if="help" class="help-text">{{ help }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: ["label", "id", "value", "help", "error"],
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