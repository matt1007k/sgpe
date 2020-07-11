<template>
  <div>
    <a @click="open = true" class="action tooltip">
      <i class="material-icons-two-tone">delete</i>
      <span>Eliminar</span>
    </a>
    <modal :open="open" @close="isClose => open = isClose">
      <div class="card">
        <div
          class="flex flex-col sm:flex-row align-center sm:align-start justify-center sm:justify-start"
        >
          <div class="ic icon-medium icon-danger">
            <i class="material-icons-two-tone">warning</i>
          </div>
          <div class="ml-1 flex flex-col">
            <h3 class="mb-1">Eliminar registro</h3>
            <p
              class="text-light-blue"
            >Estas seguro de eliminar el registro?. Esto borrar todos los datos existentes de manejar definitiva.</p>
          </div>
        </div>
        <div class="actions">
          <a class="btn btn-outline-secondary" @click="open = false">Cancelar</a>
          <button class="btn btn-danger" @click.prevent="onDelete">Eliminar</button>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "./Modal";
export default {
  props: {
    model: {
      type: Object,
      required: true
    },
    resource: {
      type: String,
      required: true
    }
  },
  components: { Modal },
  data() {
    return {
      open: false
    };
  },
  methods: {
    onDelete() {
      axios
        .delete(`/${this.resource}/${this.model.id}`)
        .then(res => location.reload())
        .catch(err => console.log(err));
    }
  }
};
</script>