<template>
  <div class="content">
    <tab-nav :filter="filter" :sort="sort" @onFilter="onFilter" @onSort="onSort" />
    <div class="list__item grid">
      <div
        class="items cols-4 sm:cols-8 md:cols-5 flex flex-col"
        style="max-height:500px;overflow-y: scroll"
      >
        <template v-for="message in messages">
          <card-message
            :message="message"
            :key="message.id"
            :class="{'card-light-blue': message === selectedMessage}"
            @onSelected="selected => selectedMessage = selected"
          />
        </template>
      </div>
      <div class="preview cols-4 sm:cols-8 md:cols-7">
        <transition name="slide-fade" mode="out-in">
          <card-preview v-if="selectedMessage" :message="selectedMessage" :send="filter" />
        </transition>
      </div>
    </div>
    <div
      class="mt-2 cols-4 sm:cols-8 md:cols-12 w-100 flex justify-between align-center flex-col sm:flex-row"
      style="justify-content: space-between"
    >
      <h3>
        Total de registros
        <span class="ml-1 text-light-blue">{{ meta.total }}</span>
      </h3>
      <paginator :links="links" :meta="meta" @onPage="onPage" />
    </div>
  </div>
</template>
<script>
import Paginator from "../Paginator";
import TabNav from "./TabNav";
import CardMessage from "./CardMessage";
import CardPreview from "./CardPreview";
export default {
  props: ["search"],
  components: { Paginator, TabNav, CardMessage, CardPreview },
  data: () => ({
    messages: [],
    links: {},
    meta: {},
    selectedMessage: null,
    filter: "me",
    sort: "-created_at",
    page: 1,
  }),
  created() {
    this.getMessages();
  },
  mounted() {
    this.message = this.messages[0];
  },
  methods: {
    getMessages() {
      this.resetPage();
      axios
        .get(this.getUrl)
        .then((res) => {
          this.messages = res.data.data;
          this.selectedMessage = this.messages[0];
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
          this.messages = res.data.data;
          this.selectedMessage = this.messages[0];
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
          this.messages = res.data.data;
          this.selectedMessage = this.messages[0];
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
          this.messages = res.data.data;
          this.selectedMessage = this.messages[0];
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
      return `/api/v1/messages?filter[search]=${this.search}&sort=${this.sort}&filter[send]=${this.filter}&page[number]=${this.page}`;
    },
  },
  watch: {
    search(value) {
      if (value.length > 3) {
        axios
          .get(this.getUrl)
          .then((res) => {
            this.messages = res.data.data;
            this.selectedMessage = this.messages[0];
            this.links = res.data.links;
            this.meta = res.data.meta;
          })
          .catch((err) => console.log(err));
      }
      this.getMessages();
    },
  },
};
</script>

<style scoped>
.seclected {
  background: silver;
}
</style>
