<template>
  <div class="grid grid-cols-4 py-5">
    <div class="col-start-4">
      <div class="flex rounded-md shadow-sm">
        <div class="relative flex items-stretch flex-grow focus-within:z-10">
          <input type="text" v-model="searchText" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="Search..." />
        </div>
        <button @click.prevent="search" type="button" class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
          <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
          <span>Search</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { SearchIcon } from '@heroicons/vue/solid'

export default {
  components: {
    SearchIcon,
  },
  setup(props, context) {
    
    const searchText = ref('')

    const search = () => {
      context.emit('search', searchText.value)
    }

    return {
      searchText,
      search,
    } 
  }
}
</script>