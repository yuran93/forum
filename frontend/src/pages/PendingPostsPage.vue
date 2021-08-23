<template>
  <AuthLayout>
    <Header title="Pending Posts" />
    <MainContent>
      <SearchPost @search="getPosts" />
      <Posts :posts="posts" />
    </MainContent>
  </AuthLayout>
</template>


<script>
import MainContent from '../components/MainContent.vue'
import SearchPost from '../components/SearchPost.vue'
import AuthLayout from '../layouts/AuthLayout.vue'
import Header from '../components/Header.vue'
import Posts from '../components/Posts.vue'
import { ref } from '@vue/reactivity'
import axios from 'axios'
import { onMounted } from '@vue/runtime-core'

export default {
  components: {
    MainContent,
    SearchPost,
    AuthLayout,
    Header,
    Posts,
  },
  setup() {

    const posts = ref([])

    const getPosts = async (search = '') => {
      try {
        let response = await axios.get(`${BASE_ENDPOINT}/api/pending-posts?search=${search}`)

        posts.value = response.data.data
      } catch (err) {
        alert(err.response.data.message)
      }
    }

    onMounted(getPosts)

    return {
      getPosts,
      posts,
    }
  }
}
</script>