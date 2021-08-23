<template>
  <AuthLayout>
    <Header title="Post View" />
    <MainContent>
      <div class="grid grid-cols-3 gap-x-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg col-span-2">
          <div class="grid grid-cols-2 gap-x-4">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ post.title }}
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ post.author }}
              </p>
            </div>
            <div class="grid grid-cols-2 gap-x-4 p-5 border-b border-gray-200">
              <div>
                <button type="button"
                  v-if="post.can_approve" 
                  @click.prevent="approvePost"
                  class="inline-flex w-full items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Approve Post
                </button>
              </div>
              <div>
                <button type="button" 
                v-if="post.can_remove" 
                  @click.prevent="removePost"
                  class="inline-flex w-full items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                >
                  Remove Post
                </button>
              </div>
            </div>
          </div>
          <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <p class="text-sm">{{ post.body }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ post.time }}</p>
          </div>
        </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
          <ul role="list" class="divide-y divide-gray-200">
            <li v-for="comment in comments" :key="comment.id" class="p-5">
              <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                <h3 class="text-sm font-semibold text-gray-800">
                  {{ comment.user }}
                </h3>
                <p class="text-gray-400 text-xs">{{ comment.time }}</p>
                <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                  {{ comment.body }}
                </p>
              </div>
            </li>
          </ul>
          <hr>
          <div class="p-5">
            <form @submit.prevent="addComment">
              <textarea v-model="newComment" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" />

              <button type="submit" class="mt-5 w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Add Comment
              </button>
            </form>
          </div>
        </div>
      </div>
    </MainContent>
  </AuthLayout>
</template>


<script>
import MainContent from '../components/MainContent.vue'
import AuthLayout from '../layouts/AuthLayout.vue'
import Header from '../components/Header.vue'
import { ref } from '@vue/reactivity'
import axios from 'axios'
import { onMounted } from '@vue/runtime-core'
import { useRoute, useRouter } from 'vue-router'

export default {
  components: {
    MainContent,
    AuthLayout,
    Header,
  },
  setup() {

    const route = useRoute()
    const router = useRouter()
    
    const post = ref({})
    const comments = ref([])
    const newComment = ref('')

    let postId = route.params.id

    const getPost = async () => {
      try {
        let response = await axios.get(`${BASE_ENDPOINT}/api/posts/${postId}?search=${route.query.search}`)

        post.value = response.data.data
      } catch (err) {
        alert(err.response.data.message)
      }
    }

    const removePost = async () => {
      if ( confirm('Are you sure want to delete the post') ) {
        try {
          await axios.delete(`${BASE_ENDPOINT}/api/posts/${postId}`)

          router.push({ name: 'PostsPage' })
        } catch (err) {
          alert('Unable to detele the post')
        }
      }
    }
    
    const approvePost = async () => {
      try {
        await axios.post(`${BASE_ENDPOINT}/api/posts/${postId}/approve`)

        router.push({ name: 'PostsPage' })
      } catch (err) {
        alert('Unable to approve the post')
      }
    }

    const getComments = async () => {
      try {
        let response = await axios.get(`${BASE_ENDPOINT}/api/comments?post_id=${postId}`)

        comments.value = response.data.data
      } catch (err) {
        alert(err.response.data.message)
      }
    }

    const addComment = async () => {
      try {
        let response = await axios.post(`${BASE_ENDPOINT}/api/comments`, {
          post_id: postId,
          body: newComment.value,
        })

        newComment.value = ''

        await getComments()
      } catch (err) {
        alert(err.response.data.message)
      }
    }

    onMounted(getPost)
    onMounted(getComments)

    return {
      approvePost,
      removePost,
      addComment,
      newComment,
      comments,
      post,
    }
  }
}
</script>