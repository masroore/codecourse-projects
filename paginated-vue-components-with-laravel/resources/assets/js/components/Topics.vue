<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Topics</div>

                    <div class="panel-body">
                        <pages v-if="meta && topics.length" for="topics" :pagination="meta.pagination"></pages>
                        <topic v-for="topic in topics" :topic="topic"></topic>
                        <pages v-if="meta && topics.length" for="topics" :pagination="meta.pagination"></pages>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import eventHub from '../events.js'

    export default {
        data () {
            return {
                topics: [],
                meta: null
            }
        },
        methods: {
            getTopics (page) {
                this.$http.get('/topics?page=' + page).then((response) => {
                    this.topics = response.body.data
                    this.meta = response.body.meta
                })
            }
        },
        mounted() {
            this.getTopics(1)

            eventHub.$on('topics.switched-page', this.getTopics)
        }
    }
</script>
