<template>
    <div class="media topic">
        <div class="media-left">
            <a href="#">
                <img class="media-object" v-bind:src="topic.user.data.avatar">
            </a>
        </div>
        <div class="media-body">
            <h5 class="media-heading"><a href="#">{{ topic.title }}</a></h5>
            by {{ topic.user.data.name }}
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'topic'
        ]
    }
</script>

<style scoped>
    .topic {
        padding: 0 0 10px 0;
    }
</style>