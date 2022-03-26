<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <pages v-if="meta && users.length" for="users" :pagination="meta.pagination"></pages>

                        <div class="media" v-for="user in users">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" v-bind:src="user.avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><a href="#">{{ user.name }}</a></h5>
                            </div>
                        </div>

                        <pages v-if="meta && users.length" for="users" :pagination="meta.pagination"></pages>
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
                users: [],
                meta: null
            }
        },
        methods: {
            getUsers (page) {
                this.$http.get('/users?page=' + page).then((response) => {
                    this.users = response.body.data
                    this.meta = response.body.meta
                })
            }
        },
        mounted() {
            this.getUsers(1)

            eventHub.$on('users.switched-page', this.getUsers)
        }
    }
</script>
