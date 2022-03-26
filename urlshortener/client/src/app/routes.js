import errors from './errors/routes'
import shortener from './shortener/routes'
import stats from './stats/routes'

export default [...stats, ...shortener, ...errors]

