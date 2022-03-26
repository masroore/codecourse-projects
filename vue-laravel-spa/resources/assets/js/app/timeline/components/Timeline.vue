<template>
    <div>
        <p>{{ index }}</p>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                index: null
            }
        },
        mounted () {
            axios.get('/api/timeline').then((response) => {
                this.index = response.data.data
            })
        }
    }
</script>