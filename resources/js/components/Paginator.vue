<template>
  <nav v-if="meta.last_page > 1">
    <ul class="pagination">
      <li class="page-item" :class="{ 'disabled': meta.current_page == 1}">
        <span v-if="meta.current_page == 1" class="page-link">Primera</span>
        <a v-else class="page-link" @click="$emit('onPage', 1)">Primera</a>
      </li>

      <template v-for="(page, index) in pages">
        <li class="page-item" :key="index" :class="{'active': page == meta.current_page}">
          <span v-if="page == meta.current_page" class="page-link">{{ page }}</span>
          <a v-else class="page-link" @click="$emit('onPage', page)">{{ page }}</a>
        </li>
      </template>

      <li class="page-item" :class="{ 'disabled': meta.current_page == meta.last_page}">
        <span v-if="meta.current_page === meta.last_page" class="page-link">Última</span>
        <a v-else class="page-link" @click="$emit('onPage', meta.last_page)">Última</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    links: {
      type: Object,
      required: true,
    },
    meta: {
      type: Object,
      required: true,
    },
  },
  computed: {
    pages() {
      return this.meta.last_page;
    },
  },
};
</script>

<style lang="scss" scoped>
</style>