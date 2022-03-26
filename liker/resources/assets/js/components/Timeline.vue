<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <post-form></post-form>
                        <hr>
                        <post v-for="post in posts" :post="post"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import eventHub from '../event'
    import Post from './Post.vue'
    import PostForm from './PostForm.vue'

    export default {
        data () {
            return {
                posts: []
            }
        },
        components: [
            Post, PostForm
        ],
        methods: {
            addPost (post) {
                this.posts.unshift(post)
            },
            likePost (postId, likedByCurrentUser) {
                var i

                for (i = 0; i <= this.posts.length; i++) {
                    if (this.posts[i].id === postId) {
                        this.posts[i].likeCount++

                        if (likedByCurrentUser) {
                            this.posts[i].likedByCurrentUser = true
                        }

                        break
                    }
                }
            }
        },
        mounted() {
            eventHub.$on('post-added', this.addPost)
            eventHub.$on('post-liked', this.likePost)

            this.$http.get('/posts').then((response) => {
                Echo.private('posts').listen('PostWasCreated', (e) => {
                    eventHub.$emit('post-added', e.post)
                })

                Echo.private('likes').listen('PostWasLiked', (e) => {
                    eventHub.$emit('post-liked', e.post.id, false)
                })

                if (window.Notification && Notification.permission !== 'denied') {
                    Notification.requestPermission((status) => {
                        Echo.private('App.User.' + this.$root.user.id).listen('PostWasLiked', (e) => {
                            new Notification('Post liked', {
                                body: e.user.name + ' liked your post "' + e.post.body + '"'
                            })
                        })
                    })
                }

                this.posts = response.body
            })
        }
    }
</script>
