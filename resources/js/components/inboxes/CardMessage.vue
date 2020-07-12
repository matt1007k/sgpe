<template>
  <div class="mb-1 card card-message flex flex-col pointer" @click="$emit('onSelected', message)">
    <div class="text-left">
      <div class="mb-1 flex justity-between align-center">
        <p class="text-sm text-light-blue">{{ message.attributes.user.attributes.name }}</p>
        <p class="text-sm text-light-blue">{{ message.attributes.created_date }}</p>
      </div>
      <h3>{{ message.attributes.subject }}</h3>
      <div class="message-body text-truncate truncate-overflow" v-html="compiledMarkdown"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: Object,
      required: true
    }
  },
  computed: {
    compiledMarkdown: function() {
      return marked(this.message.attributes.body, {
        sanitize: true
      });
    }
  }
};
</script>