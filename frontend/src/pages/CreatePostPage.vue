<template>
  <AuthLayout>
    <Header title="Create Post" />
    <MainContent>
      <form @submit.prevent="createPost">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="company-website" class="block text-sm font-medium text-gray-700">
                  Title
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" v-model="title" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="Post title" />
                </div>
              </div>
            </div>

            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">
                Body
              </label>
              <div class="mt-1">
                <textarea v-model="body" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Post content" />
              </div>
            </div>

          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Create Post
            </button>
          </div>
        </div>
      </form>
    </MainContent>
  </AuthLayout>
</template>


<script>
import MainContent from '../components/MainContent.vue'
import AuthLayout from '../layouts/AuthLayout.vue'
import Header from '../components/Header.vue'
import { ref } from '@vue/reactivity'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default {
  components: {
    MainContent,
    AuthLayout,
    Header,
  },

  setup() {

    const title = ref('')
    const body = ref('')

    const router = useRouter()

    const createPost = async () => {
      try {
        let response = await axios.post(`${BASE_ENDPOINT}/api/posts`, {
          title: title.value,
          body: body.value,
        })

        router.push({ name: 'PostsPage' })
      } catch (err) {
        alert(err.response.data.message)
      }
    }

    return {
      createPost,
      title,
      body,
    }
  }
}
</script>