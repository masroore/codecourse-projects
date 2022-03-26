<template>
    <form action="#" @submit.prevent="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="2" v-model="body"></textarea>
            <button class="btn btn-default" type="submit">Post</button>
        </div>
    </form>
</template>

<script>
    export default {
        data () {
            return {
                body: null
            }
        },
        props: [
            'tweets'
        ],
        methods: {
            post () {
                this.$http.post('/tweets', {body: this.body}).then((response) => {
                    this.tweets.unshift(response.body);
                    this.body = null
                });
            }
        }
    }
</script>
