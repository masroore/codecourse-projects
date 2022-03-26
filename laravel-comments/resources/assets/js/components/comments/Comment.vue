<template>
    <li class="media mt-4 mb-4" :id="`comment-${comment.id}`">
        <img class="mr-3" :src="comment.user.avatar">
        <div class="media-body">
            <p class="mb-2">
                <strong>{{ comment.user.name }}</strong>
                <template v-if="comment.child">
                    replied
                </template>
                {{ comment.created_at }}
                <span v-if="comment.edited" :title="comment.edited">
                    (edited)
                </span>
            </p>
            
            <template v-if="editing">
                <comment-edit :comment="comment" />
            </template>
            <template v-else>
                <div v-html="body" v-highlightjs></div>
            </template>

            <ul class="list-inline" v-if="links && user.authenticated && !editing">
                <li class="list-inline-item" v-if="!comment.child">
                    <a href="#" @click.prevent="reply">Reply</a>
                </li>
                <template v-if="comment.owner">
                    <li class="list-inline-item">
                        <a href="#" @click.prevent="editing = true">Edit</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" @click.prevent="destroy">Delete</a>
                    </li>
                </template>
            </ul>

            <template v-if="comment.children">
                <ul class="list-unstyled">
                    <comment v-for="child in comment.children" :key="child.id" :comment="child" />
                </ul>
            </template>
        </div>
    </li>
</template>

<script>
    import Comment from './Comment'
    import CommentEdit from './CommentEdit'
    import bus from '../../bus'
    import marked from 'marked'

    export default {
        name: 'comment',
        data () {
            return {
                editing: false
            }
        },
        computed: {
            body () {
                return marked(this.comment.body, { sanitize: true })
            }
        },
        props: {
            links: {
                default: true,
                type: Boolean
            },
            comment: {
                required: true,
                type: Object
            }
        },
        components: {
            Comment,
            CommentEdit
        },
        methods: {
            reply () {
                bus.$emit('comment:reply', this.comment)
            },
            async destroy () {
                if (confirm('Are you sure you want to delete this comment?')) {
                    await axios.delete(`/comments/${this.comment.id}`)
                    bus.$emit('comment:deleted', this.comment)
                }
            }
        },
        mounted () {
            bus.$on('comment:edit-cancelled', (comment) => {
                if (comment.id === this.comment.id) {
                    this.editing = false
                }
            })
        }
    }
</script>