export const setMessage = ({ commit }, message) => {
  commit('setMessage', message)

  setTimeout(() => {
    commit('setMessage', null)
  }, 3000)
}
