<template>
    <div class="like">
        <a href="#" class="btn btn-default like__button" @click.prevent="like">I like this</a>
    </div>
</template>

<script>
    import eventHub from '../event'

    export default {
        props: [
            'post'
        ],
        methods: {
            like () {
                this.$http.post('/posts/' + this.post.id + '/likes').then((response) => {
                    eventHub.$emit('post-liked', this.post.id, true)
                });
            }
        }
    }
</script>

<style scoped>
    .like {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        background: rgba(0, 0, 0, .05);
        border-radius: 3px;
        box-sizing: border-box;
    }

    .like__button {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translate(0, -50%);
    }
</style>

