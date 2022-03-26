export default {
  page: {
    current: 1,
    max: null,
    hasMore () {
      return this.current < this.max
    }
  },
  podcasts: []
}
