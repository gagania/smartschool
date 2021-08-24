import { faWindowRestore } from "@fortawesome/free-solid-svg-icons";

const state = {
    user : {}
};
const getter = {};
const actions = {
    loginUser( {},user) {
        axios.post('api/login/',{
            email :user.email,
            password:user.password
        })
        .then (response => {
            console.log(response.data)
             if (response.data.token) {
                 
                 //save the token
                 localStorage.setItem('token',response.data.token)
                 localStorage.setItem('user_type',response.data.user.type)
                 localStorage.setItem('user_id',response.data.user.id)

                 window.location.replace('/home')
             }
        })
    },
    registerUser( {},user) {
        axios.post('api/register',{
            name : user.name,
            email :user.email,
            type :user.type,
            schl_name :user.schl_name,
            password:user.password
        })
        .then (response => {
             if (response.data.token) {
                 window.location.replace('/login')
             }
        })
    },
    logoutUser( {}) {
        axios.post('api/logout')
        .then(response => {
            console.log(response);
            localStorage.removeItem('token');
            window.location.href = "/login"
        })
    },
    created() {
        axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('token')
    }

};
const mutation = {};

export default {
    namespaced :true,
    state,
    actions,
    getter,
    mutation
}