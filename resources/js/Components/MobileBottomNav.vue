<template>
    <nav
        class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-md
               shadow-xl py-2 px-6 flex justify-between items-center
               rounded-t-3xl border-t border-gray-200 z-50 md:hidden">

        <button
            v-for="item in menu"
            :key="item.label"
            @click="go(item.route)"
            class="flex flex-col items-center gap-1 flex-1 transition"
        >
            <component
                :is="item.icon"
                :class="[
                    'w-6 h-6 transition',
                    isActive(item.route) ? 'text-blue-600' : 'text-gray-400'
                ]"
            />

            <span
                :class="[
                    'text-xs font-medium transition',
                    isActive(item.route) ? 'text-blue-600' : 'text-gray-400'
                ]"
            >
                {{ item.label }}
            </span>
        </button>

    </nav>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import {
    HomeIcon,
    CalendarIcon,
    UserGroupIcon,
    UserCircleIcon,
    ChartPieIcon,
    CpuChipIcon,
} from '@heroicons/vue/24/outline'

const user = usePage().props.auth.user

// Menus por ROLE
const adminMenu = [
    { label: 'Dashboard', route: '/dashboard', icon: HomeIcon },
    { label: 'Eventos', route: '/events', icon: CalendarIcon },
    { label: 'Usuários', route: '/users', icon: UserGroupIcon },
    { label: 'Perfil', route: '/profile', icon: UserCircleIcon },
]

const managerMenu = [
    { label: 'Eventos', route: '/events', icon: CalendarIcon },
    { label: 'Vendas', route: '/sales', icon: ChartPieIcon },
    { label: 'Dispositivos', route: '/devices', icon: CpuChipIcon },
    { label: 'Perfil', route: '/profile', icon: UserCircleIcon },
]

const menu = user?.role === 'admin' ? adminMenu : managerMenu

const isActive = (route) => usePage().url.startsWith(route)

const go = (route) => router.visit(route)
</script>

<style scoped>
nav button:active {
    transform: scale(0.95);
}
</style>
