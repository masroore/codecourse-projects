import axios from 'axios'

export const post = ({ url }) => {
  return axios.post(`${process.env.API_URL}`, { url })
}

