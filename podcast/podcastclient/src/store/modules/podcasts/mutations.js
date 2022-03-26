export const setPodcasts = (state, podcasts) => {
  state.podcasts = podcasts
}

export const appendToPodcasts = (state, podcasts) => {
  state.podcasts.push(...podcasts)
}

export const setPageData = (state, { current, max }) => {
  state.page.current = current
  state.page.max = max || state.page.max
}
