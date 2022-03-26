<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li v-bind:class="{ 'disabled': !pagination.links.previous }">
                <a href="#" aria-label="Previous" @click.prevent="switchPage(pagination.current_page - 1)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li
                v-for="page in parseInt(pagination.total_pages)"
                class="page-item"
                v-bind:class="{ 'active': pagination.current_page === page }"
            >
                <a href="#" @click.prevent="switchPage(page)">{{ page }}</a>
            </li>
            <li v-bind:class="{ 'disabled': !pagination.links.next }">
                <a href="#" aria-label="Next" @click.prevent="switchPage(pagination.current_page + 1)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import eventHub from '../events.js'

    export default {
        props: {
            pagination: Object,
            for: {
                type: String,
                default: 'default'
            }
        },
        methods: {
            switchPage (page) {
                if (page < 1 || page > this.pagination.total_pages) {
                    return
                }

                eventHub.$emit(this.for + '.switched-page', page)
            }
        }
    }
</script>