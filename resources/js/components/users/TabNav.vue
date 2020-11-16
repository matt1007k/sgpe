<template>
  <div class="content mt-0">
    <div class="grid">
      <div class="cols-4 sm:cols-6 md:cols-5">
        <div class="btn-group">
          <a
            class="btn btn-full"
            :class="{ 'btn-secondary': filter === 'verified' }"
            @click="$emit('onFilter', 'verified')"
          >
            <i class="material-icons-two-tone left">verified</i>
            <span>Verificados</span>
          </a>
          <a
            class="ml-1 btn btn-full"
            :class="{ 'btn-secondary': filter === 'unverified' }"
            @click="$emit('onFilter', 'unverified')"
          >
            <i class="material-icons-two-tone left">person_remove</i>
            <span>Sin Verificar</span>
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
      required: true,
    },
    sort: {
      type: String,
    },
  },
  data: () => ({
    list: [
      { title: "Últimos", order: "-created_at", icon: "arrow_upward" },
      { title: "Antiguos", order: "created_at", icon: "sort_by_alpha" },
    ],
  }),
};
</script>