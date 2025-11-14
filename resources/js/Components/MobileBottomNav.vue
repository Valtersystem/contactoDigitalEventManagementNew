<template>
    <nav
        class="fixed bottom-0 left-0 w-full bg-white shadow-xl py-2 px-6 flex justify-between items-center
               rounded-t-3xl border-t border-gray-200 z-50">

        <!-- Item -->
        <button
            v-for="item in menu"
            :key="item.label"
            @click="go(item.route)"
            class="flex flex-col items-center gap-1 flex-1"
        >
            <component
                :is="item.icon"
                :class="[
                    'w-6 h-6 transition',
                    isActive(item.route) ? 'text-blue-600' : 'text-gray-400'
                ]"
            />

            <span :class="[
                'text-xs transition font-medium',
                isActive(item.route) ? 'text-blue-600' : 'text-gray-400'
            ]">
                {{ item.label }}
            </span>
        </button>

    </nav>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { HomeIcon, UserIcon, ChatBubbleLeftIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline'

const menu = [
    { label: 'Chat',     route: 'chat',     icon: ChatBubbleLeftIcon },
    { label: 'Me',       route: 'me',       icon: UserIcon },
    { label: 'Explore',  route: 'explore',  icon: MagnifyingGlassIcon },
    { label: 'Profile',  route: 'profile',  icon: UserIcon },
]

const isActive = (routeName) => {
    return usePage().url.startsWith(`/${routeName}`)
}

const go = (routeName) => {
    router.visit(`/${routeName}`)
}
</script>
