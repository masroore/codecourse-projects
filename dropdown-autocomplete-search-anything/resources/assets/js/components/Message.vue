<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Message</div>

                    <div class="panel-body">
                        <form action="#" @submit.prevent="send">
                            <div class="form-group">
                                <label for="users">Choose users</label>
                                <input type="text" name="users" id="users" class="form-control">
                            </div>

                            <ul class="list-inline">
                                <li v-for="recipient in recipients">{{ recipient.name }} [<a href="#" @click.prevent="removeRecipient(recipient)">x</a>]</li>
                            </ul>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" cols="30" rows="4" class="form-control" v-model="body"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { userautocomplete } from '../helpers/autocomplete.js'

    export default {
        data () {
            return {
                body: null,
                recipients: [],
            }
        },
        methods: {
            send () {
                const recipientIds = this.recipients.map((r) => {
                    return r.id
                })

                axios.post('/messages', {
                    body: this.body,
                    recipientIds: recipientIds
                })
            },
            addRecipient (recipient) {
                var existing = this.recipients.find((r) => {
                    return r.id === recipient.id
                })

                if (existing) {
                    return
                }

                this.recipients.push(recipient)
            },
            removeRecipient (recipient) {
                this.recipients = this.recipients.filter((r) => {
                    return r.id !== recipient.id
                })
            }
        },
        mounted () {
            var users = userautocomplete('#users').on('autocomplete:selected', (e, selection) => {
                this.addRecipient(selection)
                users.autocomplete.setVal('')
            })
        }
    }
</script>
