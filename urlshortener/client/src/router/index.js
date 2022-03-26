import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import routes from '@/app/routes'

export default new Router({
  mode: 'history',
  routes: routes
})
