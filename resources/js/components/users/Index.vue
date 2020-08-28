<template>
  <div>
    <div class="bg-light-primary-opacity-20 py-2 px-2">
      <div class="container">
        <div class="my-2 flex justity-between">
          <h2>Usuarios</h2>
          <a href="/users/create" class="btn btn-primary">
            <i class="material-icons">add</i>
            Nuevo usuario
          </a>
        </div>
        <div class="grid">
          <div class="rounded-md bg-white py-1 px-1 md:px-2 cols-4 sm:cols-6 flex align-center">
            <text-field-search
              v-model="search"
              @input="newValue => search = newValue"
              placeholder="Que usuario buscas..."
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