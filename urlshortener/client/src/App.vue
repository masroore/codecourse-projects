<template>
  <div id="app">
    <message></message>
    <router-view></router-view>
  </div>
</template>

<script>
  import Message from '@/app/global/components/Message'

  export default {
    name: 'app',
    components: {
      Message
    }
  }
</script>

<style lang="scss">
  @import '~styles/app.scss';

  * {
    box-sizing: border-box;
  }

  body, html {
    height: 100%;
  }

  body {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    margin: 0;
    background: #457fca;
    background: linear-gradient(to left, #457fca, #5691c8);
  }

  #app {
    height: 100%;
  }
</style>
