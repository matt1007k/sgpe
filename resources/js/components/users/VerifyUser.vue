<template>
  <div
    class="modal"
    x-show="open"
    x-transition:enter="transition"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition"
    x-transition:leave-end="opacity-0 -translate-y-3"
  >
    <div class="modal-content" style="
                width: 500px;">
      <div class="close" @click="reload">
        <i class="material-icons">close</i>
      </div>
      <div class="card">
        <h3>Verificar usuario</h3>
        <div class="group-input search-input">
          <i class="material-icons left">search</i>
          <input
            type="search"
            class="input"
            v-model="q"
            placeholder="Que usuario buscas..."
            @focus="info = true"
          />

          <transition name="slide-fade">
            <div v-if="info" class="my-2 py-2 px-3 text-center mx-auto" style="max-width: 55%">
              <img src="/images/client/icon/focus-search.svg" alt="Focus search" />
              <p class="text-light-blue">
                Buscar por el nombre, apellidos
                o dni (recomendado)
              </p>
            </div>
          </transition>

          <div v-if="loading" class="my-2 flex align-center justify-center text-primary">
            <div class="ic icon-small icon-blue">
              <i class="material-icons transition rotate-infinity">cached</i>
            </div>
            <span class="ml-1">Verificando...</span>
          </div>
        </div>

        <!-- <transition-group
          name="slide-fade"
          tag="ul"
          v-bind:css="false"
          v-on:bstaggered-enter="beforeEnter"
          v-on:enter="enter"
          v-on:leave="leave"
          class="list-group result"
        >-->
        <ul class="list-group result" v-if="users.length || !info">
          <li
            class="list-item bg-primary"
            v-for="(user, index) in users"
            :key="index"
          >{{ user.full_name }}</li>
        </ul>
        <!-- </transition-group> -->

        <transition name="fade">
          <template v-if="!users.length && !verified">Sin resultados</template>
        </transition>
        <div class="actions">
          <a class="btn btn-outline-secondary" @click="reload">Cancelar</a>
          <transition name="slide-fade">
            <button
              class="btn btn-primary transition"
              v-if="!verified"
              @click.prevent="verifyUser"
              :disabled="info || loading"
            >Verificar</button>
          </transition>
          <transition name="fade">
            <button
              class="btn btn-success transition"
              v-if="!loading && verified"
              @click.prevent="markVerified"
            >
              <i class="material-icons left">check</i>
              Verificado
            </button>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    dni: {
      type: String
      //   required: true
    }
  },
  data() {
    return {
      q: "",
      info: false,
      users: [],
      loading: false,
      verified: false
    };
  },
  created() {
    this.q = this.dni;
    this.info = false;
  },
  methods: {
    verifyUser() {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
        if (this.loading === false) {
          this.searchUser(this.q);
        }
      }, 2000);
    },
    searchUser(user) {
      axios
        .get(`/api/v1/verify-user`, {
          params: {
            q: user
          }
        })
        .then(res => {
          //   this.loading = false;
          this.users = res.data.data;
          this.checkUserVerified();
        })
        .catch(err => console.log(err));
    },
    checkUserVerified() {
      if (this.users.length > 0) {
        const userVerified = this.users.filter(user => {
          let verified = false;
          const userDataArray = this.convertStringToArray(user.full_name);
          userDataArray.push(user.dni);

          const searchFieldArray = this.convertStringToArray(this.q);

          searchFieldArray.forEach(value => {
            if (userDataArray.includes(value)) verified = true;
          });
          return verified;
        });
        if (userVerified) {
          this.verified = true;
        } else {
          this.verified = false;
        }
      }
    },
    convertStringToArray(string) {
      const stringToLowerCase = string.toLowerCase();
      const array = stringToLowerCase.split(" ");
      return array;
    },
    markVerified() {
      axios
        .post(`/mark-verified/${this.users[0]["dni"]}`)
        .then(res => {
          location.href = "/users";
        })
        .catch(error => console.log(error));
    },
    reload() {
      location.reload();
    }
  },
  watch: {
    q(value) {
      if (value.length > 0) {
        this.info = false;
        this.verified = false;
      } else {
        this.info = true;
      }
      // this.verifyUser(value);
      return this.value;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>