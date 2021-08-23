<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Sign in to your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email address
            </label>
            <div class="mt-1">
              <input v-model="username" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <div class="mt-1">
              <input v-model="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="text-sm">
              <a href="#" @click.prevent="router.push({ name: 'RegisterPage' })" 
                class="font-medium text-indigo-600 hover:text-indigo-500">
                Register as New User
              </a>
            </div>
          </div>

          <hr>

          <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click.prevent="attemptLogin">
              Sign in
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref } from '@vue/reactivity'
import { useRouter } from 'vue-router'

export default {
  setup() {

    const username = ref('')
    const password = ref('')
    const loading = ref(false)
    const router = useRouter()

    const attemptLogin = async () => {

      loading.value = true

      try {

        let response = await axios.post(`${BASE_ENDPOINT}/api/login`, {
          username: username.value,
          password: password.value
        })

        console.log(response.data)

        localStorage.setItem('user', JSON.stringify(response.data))

        router.push({ name: 'PostsPage' })
        
      }
      catch (err) {
        alert(err.response.data.message)
      }

      loading.value = false

    }

    return {
      attemptLogin,
      username,
      password,
      loading,
      router,
    }
  },
}
</script>