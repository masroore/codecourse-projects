export const setUrl = (state, url) => {
  state.url = url
}

export const setShortened = (state, data) => {
  state.shortened = data
}

export const setWaiting = (state, trueOrFalse) => {
  state.waiting = trueOrFalse
}
