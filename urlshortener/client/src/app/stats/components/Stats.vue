<template>
  <div class="container container--centered">
    <div class="stats" v-if="stats">
      <h1 class="stats__header">
        Stats for {{ stats.shortened_url }}
      </h1>
      <dl class="dlist">
        <dt class="dlist__title">Origin URL</dt>
        <dd class="dlist__body">{{ stats.original_url }}</dd>
      </dl>
      <dl class="dlist">
        <dt class="dlist__title">Shortening requested</dt>
        <dd class="dlist__body">{{ stats.requested_count }} {{ pluralize('time', stats.requested_count) }}</dd>
      </dl>
      <dl class="dlist">
        <dt class="dlist__title">Used</dt>
        <dd class="dlist__body">{{ stats.used_count }} {{ pluralize('time', stats.used_count) }}</dd>
      </dl>
      <dl class="dlist">
        <dt class="dlist__title">Last requested</dt>
        <dd class="dlist__body">{{ stats.last_requested }}</dd>
      </dl>
      <dl class="dlist">
        <dt class="dlist__title">Last used</dt>
        <dd class="dlist__body">{{ stats.last_used || 'Never' }}</dd>
      </dl>

      <a :href="stats.shortened_url" class="button button--yellow">Take me there</a>
    </div>
    <div v-else class="stats__loading">One moment</div>
  </div>
</template>

<script>
  import pluralize from 'pluralize'
  import { mapActions, mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters({
        stats: 'stats/stats'
      })
    },
    methods: {
      ...mapActions({
        getStats: 'stats/getStats'
      }),
      pluralize: pluralize
    },
    mounted () {
      this.getStats(this.$route.params.code).catch(() => {
        this.$router.replace({ name: 'nope' })
      })
    }
  }
</script>

<style lang="scss">
  .stats {
    color: #fff;
    font-size: 1.2em;
    font-weight: 500;
    width: 100%;

    &__header {
      font-size: 1.4em;
      margin: 0;
      margin-bottom: 40px;
      overflow-wrap: break-word;
    }

    &__loading {
      color: #fff;
      font-size: 1.2em;
      font-weight: 500;
    }
  }
</style>
