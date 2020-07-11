<template>
    <div>
        <a class="btn btn-primary" @click="open = true">
            <i class="material-icons">add</i>
            Nuevo mensaje
        </a>
        <modal :open="open" @close="isClose => (open = isClose)" width="600px">
            <div class="card">
                <h3>Redactar un correo</h3>
                <form @submit.prevent="submit">
                    <text-field
                        label="Para"
                        id="to"
                        type="email"
                        v-model="form.to"
                        @input="form.to = $event"
                        :error="errors.to"
                        required
                    />
                    <text-field
                        label="Asunto"
                        id="subject"
                        v-model="form.subject"
                        @input="form.subject = $event"
                        :error="errors.subject"
                        required
                    />
                    <div class="group-input">
                        <label for="body">Mensaje</label>
                        <vue-simplemde
                            v-model="form.body"
                            ref="markdownEditor"
                            class="simplemde"
                        />
                        <div v-if="errors.body" class="text-invalid">
                            {{ errors.body[0] }}
                        </div>
                    </div>

                    <div class="actions">
                        <a
                            class="btn btn-outline-secondary"
                            @click="open = false"
                            >Cancelar</a
                        >
                        <button class="btn btn-primary">
                            <i class="material-icons-two-tone left">send</i>
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
import Modal from "../Modal";

import TextField from "../form/TextField";

export default {
    components: { Modal, TextField },
    data: () => ({
        open: false,
        form: {},
        errors: {}
    }),
    methods: {
        submit() {
            axios
                .post("/inboxes", this.form)
                .then(res => location.reload())
                .catch(err => (this.errors = err.response.data.errors));
        }
    }
};
</script>

<style>
.CodeMirror {
    height: 200px;
    min-height: 100px;
}
</style>
