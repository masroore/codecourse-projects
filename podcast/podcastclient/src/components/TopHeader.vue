<template>
  <header class="topheader">
      <div class="container">
        <player v-if="playing" :podcast="playing"></player>
        <p v-else class="welcome">Oh, hi. <strong>Choose something to play.</strong></p>
      </div>
  </header>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Player from './player/Player'

  export default {
    name: 'top-header',
    components: {
      Player
    },
    computed: {
      ...mapGetters({
        playing: 'player/getPlaying'
      })
    }
  }
</script>

<style lang="scss">
  @import '~styles/variables';

  .welcome {
    font-size: 1.1em;
    text-align: center;
  }

  .topheader {
    display: flex;
    align-items: center;
    width: 100%;
    height: $header-height;
    background-color: #fff;
    position: fixed;
    top: 0; left: 0;
    padding: $header-padding;
    z-index: 2;
  }
</style>
