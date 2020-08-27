<template>
  <div>
    <div class="bg-light-primary-opacity-20 py-2 px-2">
      <div class="container">
        <div class="my-2 flex justity-between">
          <h2>Correos</h2>
          <sent-message />
        </div>
        <div class="grid">
          <div class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6 flex align-center">
            <!-- <div class="search-input">
              <i class="material-icons left icon">search</i>
              <input type="search" class="input border-none" placeholder="Que correo buscas..." />
            </div>-->
            <!-- <button class="btn btn-dark">Buscar</button> -->
            <text-field-search
              v-model="search"
              @input="newValue => search = newValue"
              placeholder="Que correo buscar..."
            />
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <tab-container :search="search" />
    </div>
  </div>
</template>
<script>
import TextFieldSearch from "../form/TextFieldSearch";
import TabContainer from "./TabContainer";
export default {
  components: { TextFieldSearch, TabContainer },
  data: () => ({
    search: "",
  }),
};
</script>