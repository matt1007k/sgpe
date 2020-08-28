<template>
  <div>
    <div class="content">
      <tab-nav :filter="filter" :sort="sort" @onFilter="onFilter" @onSort="onSort" />
      <div class="list__item">
        <template v-if="users">
          <template v-for="user in users">
            <CardUser :key="user.id" :user="user.attributes" :id="user.id" />
          </template>
        </template>
        <template v-else>
          <not-data>No hay ningún registro.</not-data>
        </template>

        <div
          class="w-100 flex justify-between align-center flex-col sm:flex-row"
          style="justify-content: space-between"
        >
          <h3>
            Total de registros
            <span class="ml-1 text-light-blue">{{ meta.total }}</span>
          </h3>
          <paginator :links="links" :meta="meta" @onPage="onPage" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Paginator from "../Paginator";
import TabNav from "./TabNav";
import CardUser from "./CardUser";
export default {
  props: ["search"],
  components: { Paginator, TabNav, CardUser },
  data: () => ({
    users: [],
    links: {},
    meta: {},
    filter: "verified",
    sort: "-created_at",
    page: 1,
  }),
  created() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      this.resetPage();
      axios
        .get(this.getUrl)
        .then((res) => {
          this.users = res.data.data;
          this.links = res.data.links;
          this.meta = res.data.meta;
        })
        .catch((err) => console.log(err));
    },
    onPage(page) {
      this.page = page;
      axios
        .get(this.getUrl)
        .then((res) => {
          this.users = res.data.data;
          this.links = res.data.links;
          this.meta = res.data.meta;
        })
        .catch((err) => console.log(err));
    },
    onFilter(newFilter) {
      this.filter = newFilter;
      this.resetPage();
      axios
        .get(this.getUrl)
        .then((res) => {
          this.users = res.data.data;
          this.links = res.data.links;
          this.meta = res.data.meta;
        })
        .catch((err) => console.log(err));
    },
    onSort(newSort) {
      this.sort = newSort;
      this.resetPage();
      axios
        .get(this.getUrl)
        .then((res) => {
          this.users = res.data.data;
          this.links = res.data.links;
          this.meta = res.data.meta;
        })
        .catch((err) => console.log(err));
    },
    resetPage() {
      this.page = 1;
    },
  },
  computed: {
    getUrl() {
      return `/api/v1/users?filter[search]=${this.search}&sort=${this.sort}&filter[status]=${this.filter}&page[number]=${this.page}`;
    },
  },
  watch: {
    search(value) {
      if (value.length > 3) {
        axios
          .get(this.getUrl)
          .then((res) => {
            this.users = res.data.data;
            this.links = res.data.links;
            this.meta = res.data.meta;
          })
          .catch((err) => console.log(err));
      }
      this.getUsers();
    },
  },
};
</script>