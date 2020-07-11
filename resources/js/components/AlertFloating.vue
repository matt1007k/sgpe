<template>
    <transition name="bounce">
        <div class="alert-floating alert-floating-success" v-show="open">
            <div class="icon">
                <i class="material-icons">check</i>
            </div>
            <span class="mr-1">
                <slot />
            </span>
            <div class="close" @click="open = false">
                <i class="material-icons">close</i>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ["open"],
    data: () => ({
        open: this.open
    })
};
</script>

<style lang="scss" scoped></style>
