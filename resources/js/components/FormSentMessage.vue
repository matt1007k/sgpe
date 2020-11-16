<template>
    <form @submit.prevent="submit">
        <h3>Redactar un correo</h3>
        <div class="group-input">
            <label for="to">Para</label>
            <input type="email" class="input" v-model="form.to" />
            <template v-if="errors.to">
                <div class="text-invalid">{{ errors.to[0] }}</div>
            </template>
        </div>
        <div class="group-input">
            <label for="subject">Asunto</label>
            <input
                type="email"
                class="input"
                :class="{ 'is-invalid': errors.subject }"
                v-model="form.subject"
            />
            <template v-if="errors.subject">
                <div class="text-invalid">{{ errors.subject[0] }}</div>
            </template>
        </div>
        <div class="group-input">
            <label for="body">Mensaje</label>
            <template v-if="errors.body">
                <div class="text-invalid">{{ errors.body[0] }}</div>
            </template>
        </div>
        <div class="actions">
            <!-- <a class="btn btn-outline-secondary">Cancelar</a> -->
            <button class="btn btn-primary" type="submit">
                <i class="material-icons-two-tone left">send</i>
                Enviar
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                editor: null
            },
            errors: {}
        };
    },
    //     08/07/2015 29102018
    methods: {
        submit() {
            axios
                .post("/inboxes", this.form)
                .then(res => console.log(res))
                .catch(error => console.log(error));
        }
    }
};
</script>
