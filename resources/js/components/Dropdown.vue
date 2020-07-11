<template>
    <transition name="fade">
        <div class="dropdown" v-show="open">
            <slot />
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        open: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<style lang="scss" scoped></style>
