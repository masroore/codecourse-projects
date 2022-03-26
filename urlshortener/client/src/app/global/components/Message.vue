<template>
  <transition
    enter-active-class="animate animate--top-enter"
    leave-active-class="animate animate--top-leave"
  >
    <div class="message" v-if="message">
      <div class="container container--centered container--no-padding">
        <p>{{ message }}</p>
      </div>
    </div>
  </transition>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'message'
      ])
    }
  }
</script>

<style lang="scss">
  .message {
    position: fixed;
    background-color: #fff;
    height: 80px;
    width: 100%;
    font-weight: 500;
  }
</style>
