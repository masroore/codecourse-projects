<template>
    <form action="#" class="form-vertical" @submit.prevent="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="3" placeholder="Write something likable" v-model="body"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Post it!</button>
    </form>
</template>

<script>
    import eventHub from '../event'

    export default {
        data () {
            return {
                body: null
            }
        },
        methods: {
            post () {
                this.$http.post('/posts', {
                    body: this.body
                }).then((response) => {
                    eventHub.$emit('post-added', response.body)
                    this.body = null
                })
            }
        }
    }
</script>
