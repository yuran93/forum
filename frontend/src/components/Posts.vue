<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="post in posts" :key="post.id" 
          @click.prevent="router.push({ name: 'PostPage', params: { id: post.id } })"
          class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
          <div class="flex justify-between space-x-3">
            <div class="min-w-0 flex-1">
              <a href="#" class="block focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900 truncate">{{ post.title }}</p>
                <p class="text-sm text-gray-500 truncate">{{ post.author }}</p>
              </a>
            </div>
            <time :datetime="post.datetime" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ post.time }}</time>
          </div>
          <div class="mt-1">
            <p class="line-clamp-2 text-sm text-gray-600">
              {{ post.preview }}
            </p>
          </div>
          <div class="mt-5">
            <span v-if="post.is_approved" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
              <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                <circle cx="4" cy="4" r="3" />
              </svg>
              Approved
            </span>
            <span v-else class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
              <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                <circle cx="4" cy="4" r="3" />
              </svg>
              Pending Approval
            </span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, toRefs } from '@vue/reactivity'
import { useRoute, useRouter } from 'vue-router'

export default {
  props: ['posts'],
  setup(props) {

    const router = useRouter()
    const { posts } = toRefs(props)

    return {
      router,
      posts,
    }
    
  }
}
</script>