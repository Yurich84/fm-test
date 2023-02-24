import axios from 'axios'

export default {

    getRoles() {
        return axios.get('/get-roles')
    },

    send(data) {
        return axios.post('/send-mail', data)
    },

}
