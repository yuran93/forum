<template>
  <header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
      <h1 class="text-lg leading-6 font-semibold text-gray-900">
        {{ title }}
      </h1>
    </div>
  </header>
</template>

<script>
import { toRefs } from '@vue/reactivity'

export default {
  props: ['title'],
  setup(props) {
    
    const { title } = toRefs(props)

    return {
      title
    } 
  }
}
</script>