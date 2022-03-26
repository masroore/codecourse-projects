<template>
  <div>
    <transition-group name="fade">
      <podcast-simple :key="podcast.id" v-for="podcast in podcasts" :podcast="podcast"></podcast-simple>
    </transition-group>
    <a href="#" class="load-more" v-if="page.hasMore()" @click.prevent="getMorePodcasts">Load older podcasts</a>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import PodcastSimple from './podcasts/Simple'

  export default {
    name: 'home',
    components: {
      PodcastSimple
    },
    computed: {
      ...mapGetters({
        podcasts: 'podcasts/getPodcasts',
        page: 'podcasts/getPage'
      })
    },
    methods: {
      ...mapActions({
        getPodcasts: 'podcasts/getPodcasts',
        getMorePodcasts: 'podcasts/getMorePodcasts'
      })
    },
    mounted () {
      this.getPodcasts()
    }
  }
</script>

<style lang="scss">
  .load-more {
    display: block;
    width: 100%;
    padding: 20px;
    background-color: #fff;
    text-align: center;
    margin-bottom: 40px;
    color: inherit;
    text-decoration: none;
    font-weight: 500;
  }
</style>
