<template>
  <div class="content mt-0">
    <div class="grid">
      <div class="cols-4 sm:cols-6 md:cols-5">
        <div class="btn-group">
          <a
            class="btn btn-full"
            :class="{ 'btn-secondary': filter === 'me' }"
            @click="$emit('onFilter', 'me')"
          >
            <i class="material-icons-two-tone left">all_inbox</i>
            <span>Recibidos</span>
          </a>
          <a
            class="ml-1 btn btn-full"
            :class="{ 'btn-secondary': filter === 'send' }"
            @click="$emit('onFilter', 'send')"
          >
            <i class="material-icons-two-tone left">send</i>
            <span>Enviados</span>
          </a>
        </div>
      </div>
      <div class="order cols-4 sm:cols-2 md:cols-7 align-self-center justify-self-end">
        <dropdown-sort @onOrder="value => $emit('onSort', value)" :list="list" :sortSelected="sort"></dropdown-sort>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    filter: {
      type: String,
      required: true
    },
    sort: {
      type: String
    }
  },
  data: () => ({
    list: [
      { title: "Últimos", order: "-subject", icon: "arrow_upward" },
      { title: "Antiguos", order: "subject", icon: "sort_by_alpha" }
    ]
  })
};
</script>