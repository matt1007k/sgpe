<template>
    <div class="posts-tab">
        <ul class="posts-sidebar">
            <li
                v-for="post in posts"
                :key="post.id"
                :class="{ selected: post === selectedPost }"
                @click="selectedPost = post"
            >
                {{ post.attributes.name }}
            </li>
        </ul>
        <div class="selected-post-container">
            <transition name="slide-fade" mode="out-in">
                <div v-if="selectedPost" class="selected-post" key="selected">
                    <h3>{{ selectedPost.attributes.name }}</h3>
                    <div
                        v-text="selectedPost.attributes.paternal_surname"
                    ></div>
                </div>
                <div v-else key="unselected">
                    Click on a blog title to the left to view it.
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        posts: [],
        selectedPost: null
    }),
    created() {
        this.getMessages();
    },
    mounted() {
        this.selectedPost = this.posts[0];
    },
    methods: {
        getMessages() {
            const url = "/api/v1/people";
            axios
                .get(url)
                .then(res => {
                    this.posts = res.data.data;
                    this.selectedPost = this.posts[0];
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style scoped>
.seclected {
    background: silver;
}
</style>
