<template>
  <div>
    <Disclosure as="nav" class="bg-indigo-600" v-slot="{ open }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-300.svg" alt="Workflow" />
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a href="#" 
                  v-for="item in navigation" :key="item.label"
                  class="text-white hover:bg-indigo-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium"
                  @click.prevent="router.push({ name: item.routeName })"
                >
                  {{ item.label }}
                </a>
                <a href="#" 
                  class="text-white hover:bg-indigo-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium"
                  @click.prevent="signOut"
                >
                  Sign Out
                </a>
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <div class="ml-3">
                <div class="text-sm font-medium text-white">{{ user.name }}</div>
                <div class="text-xs font-medium text-indigo-300">{{ user.email }}</div>
              </div>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton class="bg-indigo-600 inline-flex items-center justify-center p-2 rounded-md text-indigo-200 hover:text-white hover:bg-indigo-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
              <span class="sr-only">Open main menu</span>
              <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>

      <DisclosurePanel class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
          <a href="#"
            v-for="item in navigation" :key="item.label"
            class="text-white hover:bg-indigo-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium"
            @click.prevent="router.push({ name: item.routeName })"
          >
            {{ item.label }}
          </a>
          <a href="#"
            class="text-white hover:bg-indigo-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium"
            @click.prevent="signOut"
          >
            Sign Out
          </a>
        </div>
        <div class="pt-4 pb-3 border-t border-indigo-700">
          <div class="flex items-center px-5">
            <div>
              <div class="text-base font-medium text-white">{{ user.name }}</div>
              <div class="text-sm font-medium text-indigo-300">{{ user.email }}</div>
            </div>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>
    <slot></slot>
  </div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { useRouter } from 'vue-router'
import { computed } from '@vue/reactivity'

const navItems = [
  { label: 'Posts', routeName: 'PostsPage', isAdmin: false },
  { label: 'My Posts', routeName: 'MyPostsPage', isAdmin: false },
  { label: 'Pending Approval', routeName: 'PendingPostsPage', isAdmin: true },
  { label: 'Create Post', routeName: 'CreatePostPage', isAdmin: false },
]

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    XIcon,
  },
  setup() {

    const router = useRouter()

    const signOut = () => {
        localStorage.removeItem('user');
        router.push({ name: 'LoginPage' });
    }

    const user = computed(() => {
      return localStorage.getItem('user') ?
        JSON.parse(localStorage.getItem('user')) :
        { name: '', email: '' }
    })

    const navigation = navItems.filter(item => {
      return user.value.is_admin ? true : !item.isAdmin
    })

    return {
      navigation,
      signOut,
      router,
      user,
    }
  },
}
</script>