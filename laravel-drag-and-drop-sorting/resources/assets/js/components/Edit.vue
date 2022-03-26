<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing <em>{{ title }}</em></div>

                    <div class="panel-body">
                        <div class="alert alert-success" v-if="message">
                            {{ message }}
                        </div>

                        <form action="#" @submit.prevent="submit">
                            <div class="form-group" v-bind:class="{'has-error': errors.title}">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" id="title" class="form-control" v-model="title">

                                <div class="help-block" v-if="errors.title">
                                    {{ errors.title[0] }}
                                </div>
                            </div>
                            
                            <draggable :list="parts" :options="{'handle': '.panel-heading'}" @start="drag=true" @end="drag=false" @change="update">
                                <div class="panel panel-default" v-for="part, index in parts">
                                    <div class="panel-heading">Part {{ index + 1 }} ({{ part.sort_order }})</div>
                                    <div class="panel-body">
                                        <div class="form-group" v-bind:class="{'has-error': errors['parts.' + index + '.title']}">
                                            <label class="control-label">Part title</label>
                                            <input type="text" class="form-control" v-model="parts[index].title">

                                            <div class="help-block" v-if="errors['parts.' + index + '.title']">
                                                {{ errors['parts.' + index + '.title'][0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </draggable>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        data () {
            return {
                title: null,
                parts: [],
                errors: [],
                message: null
            }
        },
        props: [
            'data'
        ],
        methods: {
            submit () {
                axios.patch('/series/' + this.data.id, {
                    title: this.title,
                    parts: this.parts
                }).then((response) => {
                    this.message = 'Series saved!'
                }).catch((error) => {
                    this.errors = error.response.data
                })
            },
            update (e) {
                this.parts.map((part, index) => {
                    part.sort_order = index + 1
                })
            }
        },
        mounted () {
            this.title = this.data.title
            this.parts = this.data.parts
        }
    }
</script>