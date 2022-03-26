<template>
  <div class="podcast">
    <a href="#" class="podcast__play" @click.prevent="switchPodcast(podcast.id)" :class="{ 'podcast__play--hidden': playing && playing.id === podcast.id }">
      <img src="../../assets/img/play.svg" alt="Play" class="podcast__playbutton">
    </a>
    <div class="podcast__details">
      <div class="podcast__sub"><time :datetime="podcast.created_at">{{ podcast.created_at_human }}</time></div>
      <h1 class="podcast__header">
        <a href="#" @click.prevent="switchPodcast(podcast.id)">{{ podcast.title }}</a>
      </h1>
      <p>{{ podcast.description }}</p>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'

  export default {
    name: 'podcast-simple',
    props: [
      'podcast'
    ],
    computed: {
      ...mapGetters({
        playing: 'player/getPlaying'
      })
    },
    methods: {
      ...mapActions({
        getPodcast: 'podcasts/getPodcast',
        setPlaying: 'player/setPlaying'
      }),
      switchPodcast (id) {
        this.getPodcast(id).then((podcast) => {
          this.setPlaying(podcast)
        })
      }
    }
  }
</script>

<style lang="scss">
  @import '~styles/variables';

  .podcast {
    background-color: #fff;
    display: flex;
    min-height: 280px;
    border-radius: $global-radius;
    box-shadow: 0 5px 10px rgba(#000000, .05);
    margin-bottom: 40px;
    overflow: hidden;

    &__sub {
      font-weight: 500;
    }

    &__header {
      font-size: 1.6em;

      a {
        text-decoration: none;
      }
    }

    &__details {
      flex: 1;
      padding: 40px;
    }

    &__play {
      width: 15%;
      display: none;
      background-color: $blue;
      overflow: hidden;
      align-items: center;
      justify-content: center;
      border-top-left-radius: $global-radius;
      border-bottom-left-radius: $global-radius;
      transition: margin-left 180ms ease-in-out;

      &:hover {
        .podcast__playbutton {
          transform: scale(3.5) rotate(-10deg);
          opacity: 1;
        }
      }

      &--hidden {
        margin-left: -15%;
      }
    }

    &__playbutton {
      color: #222;
      opacity: .4;
      width: 60%;
      transition: all 180ms ease-in-out;
    }
  }

  @media only screen and (min-width: 768px) {
    .podcast__play {
      display: flex;
    }
  }
</style>
