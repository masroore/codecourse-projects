<template>
  <div class="container container--centered">
    <form action="#" class="urlform" @submit.prevent="shortenUrl" novalidate>
      <input type="url" placeholder="Let's get you a short URL" class="urlform__input" v-model="formUrl">
    </form>

    <transition enter-active-class="animate animate--grow">
      <div class="result" v-if="shortened">
        <div class="result__details">
          <div class="result__original">
            <span>{{ shortened.original_url }}</span> is now
          </div>
          <a :href="shortened.shortened_url" target="_blank" class="result__url" id="url">{{ shortened.shortened_url }}</a>
          <router-link :to="{ name: 'stats', params: { code: shortened.code } }" class="result__stats">Get stats</router-link>
        </div>
        <button class="button button--yellow" id="copy" data-clipboard-target="#url">Copy to clipboard</button>
      </div>
    </transition>

    <div class="notice" v-if="url && !shortened && !waiting">
      Hit return when you're done
    </div>

    <div class="notice" v-if="waiting">
      One moment
    </div>
  </div>
</template>

<script>
  import Clipboard from 'clipboard'
  import { mapGetters, mapMutations, mapActions } from 'vuex'

  export default {
    methods: {
      ...mapMutations({
        setUrl: 'shortener/setUrl'
      }),
      ...mapActions({
        shortenUrl: 'shortener/shortenUrl',
        setMessage: 'setMessage'
      })
    },
    computed: {
      ...mapGetters({
        url: 'shortener/url',
        shortened: 'shortener/shortened',
        waiting: 'shortener/waiting'
      }),
      formUrl: {
        get () {
          return this.url
        },
        set (value) {
          this.setUrl(value)
        }
      }
    },
    mounted () {
      let clipboard = new Clipboard('#copy')

      clipboard.on('success', (e) => {
        this.setMessage('Copied to clipboard!')
        e.clearSelection()
      })
    }
  }
</script>

<style lang="scss">
  .urlform {
    width: 100%;
    margin-bottom: 40px;

    &__input {
      font: inherit;
      font-size: 1.2em;
      padding: 20px;
      width: 100%;
      border: 0;
      outline: none;
      border-radius: 3px;
      box-shadow: 0 0 50px rgba(#fff, .1)
    }
  }

  .notice {
    color: #fff;
    font-size: 1.1em;
    font-weight: 500;
  }

  .result {
    width: 100%;
    text-align: center;

    &__details {
      color: #fff;
      font-size: 1.4em;
    }

    &__url {
      display: block;
      margin-bottom: 20px;
      color: #fff;
    }

    &__original {
      opacity: 0.5;
      margin-bottom: 5px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;

      span {
        display: inline-block;
        max-width: 300px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        margin-right: 8px;
      }
    }

    &__stats {
      display: block;
      color: #fff;
      font-size: .9em;
      margin-bottom: 20px;
    }

    @media (min-width: 736px) {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;

      &__stats {
        margin-bottom: 0;
      }

      &__details {
        margin-right: 40px;
      }
    }
  }
</style>
