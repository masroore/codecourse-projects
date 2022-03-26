import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import player from './modules/player'
import podcasts from './modules/podcasts'

export default new Vuex.Store({
  modules: {
    player,
    podcasts
  }
})
