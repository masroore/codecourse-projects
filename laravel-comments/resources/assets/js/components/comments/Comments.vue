<template>
    <div>
        <template v-if="reply">
            <comment-reply :comment="reply" />
        </template>
        <template v-else>
            <h3 class="mb-5">{{ meta.total }} {{ pluralize('comment', meta.total) }}</h3>
            <new-comment
                :endpoint="endpoint"
                v-if="user.authenticated"
             />
             <template v-if="comments.length">
                 <ul class="list-unstyled">
                    <comment v-for="comment in comments" :key="comment.id" :comment="comment" />
                 </ul>
             </template>
             <p class="mt-4" v-else>No comments to display</p>

             <a
                href="#"
                class="btn btn-light btn-block"
                @click.prevent="loadMore"
                v-if="meta.current_page < meta.last_page"
            >Show more</a>
        </template>
    </div>
</template>

<script>
    import Comment from './Comment'
    import NewComment from './NewComment'
    import CommentReply from './CommentReply'
    import bus from '../../bus'
    import axios from 'axios'
    import VueScrollTo from 'vue-scrollto'

    export default {
        data () {
            return {
                comments: [],
                meta: {},
                reply: null
            }
        },
        props: {
            endpoint: {
                required: true,
                type: String
            }
        },
        components: {
            NewComment,
            Comment,
            CommentReply
        },
        methods: {
            fetchComments(page = 1) {
                return axios.get(`${this.endpoint}?page=${this.meta.current_page}`)
            },
            async loadComments(page = 1) {
                let comments = await this.fetchComments(page)

                this.comments = comments.data.data
                this.meta = comments.data.meta
            },
            async fetchMeta () {
                let comments = await this.fetchComments(this.meta.current_page)

                this.meta = comments.data.meta
            },
            async loadMore() {
                let comments = await this.fetchComments(this.meta.current_page + 1)

                this.comments.push(...comments.data.data)
                this.meta = comments.data.meta
            },
            async loadOneAfterDeletion() {
                if (this.meta.current_page >= this.meta.last_page) {
                    return
                }

                let comments = await this.fetchComments(this.meta.current_page)

                this.comments.push(comments.data.data[comments.data.data.length - 1])
                this.meta = comments.data.meta
            },
            async prependComment (comment) {
                this.comments.unshift(comment)

                await this.fetchMeta()

                if (this.meta.current_page < this.meta.last_page) {
                    this.comments.pop()
                }
            },
            setReplying (comment) {
                this.reply = comment
            },
            appendReply (comment, reply) {
                _.find(this.comments, { id: comment.id }).children.push(reply)
            },
            scrollToComment(comment) {
                setTimeout(() => {
                    VueScrollTo.scrollTo(`#comment-${comment.id}`, 500)
                }, 100)
            },
            editComment (comment) {
                if (comment.child) {
                    _.assign(
                        _.find(
                            this.comments, { id: comment.parent_id }
                        ).children.find((child) => child.id == comment.id),
                        comment
                    )

                    return
                }

                _.assign(_.find(this.comments, { id: comment.id }), comment)
            },
            deleteComment (comment) {
                if (comment.child) {
                    let parentComment = _.find(this.comments, { id: comment.parent_id })

                    parentComment.children = parentComment.children.filter((child) => child.id !== comment.id)

                    return
                }

                this.comments = this.comments.filter((c) => c.id !== comment.id)
                this.meta.total--

                this.loadOneAfterDeletion()
            }
        },
        mounted () {
            this.loadComments(1)

            bus.$on('comment:stored', this.prependComment)
            bus.$on('comment:reply', this.setReplying)
            bus.$on('comment:reply-cancelled', () => this.reply = null)

            bus.$on('comment:replied', ({ comment, reply }) => {
                this.appendReply(comment, reply)
                this.scrollToComment(reply)
            })

            bus.$on('comment:edited', this.editComment)
            bus.$on('comment:deleted', this.deleteComment)
        }
    }
</script>