import Nope from '../components/Nope'

export default [
  {
    path: '*',
    component: Nope
  },
  {
    path: '/nope',
    name: 'nope',
    component: Nope
  }
]
