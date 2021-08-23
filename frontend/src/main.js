import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import './index.css'

window.BASE_ENDPOINT = 'http://localhost:8000'

window.AUTH_USER = () => { 
  return localStorage.user ? JSON.parse(localStorage.user) : false
};

axios.interceptors.request.use(function (config) {
  if (AUTH_USER()) {
    config.headers.common['Authorization'] = 'Bearer ' + AUTH_USER().token
  }

  return config
}, function (error) {
  // Do something with request error
  return Promise.reject(error)
})

createApp(App)
  .use(store)
  .use(router)
  .mount('#app')
