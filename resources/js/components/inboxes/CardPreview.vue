<template>
  <div class="card">
    <div class="mb-1 flex justity-between align-center">
      <div>
        {{ message.attributes.user.attributes.name }}
        <span
          class="text-light-blue text-sm"
        >({{ message.attributes.user.attributes.email }}) -></span>
        <span
          class="text-light-blue text-sm"
        >Para {{ send === 'me' ? 'mí' : message.attributes.to }}</span>
      </div>
      <btn-delete :model="message" resource="inboxes"></btn-delete>
    </div>
    <h2>{{ message.attributes.subject }}</h2>
    <p class="mb-2 text-light-blue text-sm">{{ message.attributes.created_date }}</p>
    <div class="mb-2 text-light-blue markdown" v-html="compiledMarkdown"></div>
  </div>
</template>


<script>
export default {
  props: {
    message: {
      type: Object,
      required: true
    },
    send: {
      type: String,
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