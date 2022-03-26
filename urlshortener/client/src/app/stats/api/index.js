import axios from 'axios'

export const get = ({ code }) => {
  return axios.get(`${process.env.API_URL}/stats?code=${code}`)
}
