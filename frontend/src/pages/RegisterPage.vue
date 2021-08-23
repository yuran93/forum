<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Register as New User
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Name
            </label>
            <div class="mt-1">
              <input v-model="name" type="text" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">
              Email address
            </label>
            <div class="mt-1">
              <input v-model="username" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <div class="mt-1">
              <input v-model="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="text-sm">
              <a href="#" @click.prevent="router.push({ name: 'LoginPage' })" 
                class="font-medium text-indigo-600 hover:text-indigo-500">
                Go back to login
              </a>
            </div>
          </div>

          <hr>

          <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click.prevent="register">
              Register as New User
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

    const name = ref('')
    const username = ref('')
    const password = ref('')

    const loading = ref(false)

    const router = useRouter()

    const register = async () => {

      loading.value = true

      try {

        let response = await axios.post(`${BASE_ENDPOINT}/api/register`, {
          name: name.value,
          username: username.value,
          password: password.value
        })

        localStorage.setItem('user', JSON.stringify(response.data))

        router.push({ name: 'PostsPage' })
        
      }
      catch (err) {
        alert(err.response.data.message)
      }

      loading.value = false

    }

    return {
      register,
      username,
      password,
      loading,
      router,
      name,
    }
  },
}
</script>