<script setup lang="ts">
import { ref, computed } from 'vue'; // <-- 1. Importar 'computed'
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MobileBottomNav from '@/Components/MobileBottomNav.vue'; // <-- IMPORTADO
import { Link, usePage } from '@inertiajs/vue3'; // <-- 2. Importar 'usePage'
import { User } from '@/types';
import { useDarkMode } from '@/composables/useDarkMode';

const { isDarkMode, toggleDarkMode } = useDarkMode();


const showingNavigationDropdown = ref(false);

// 3. Remover a dependência de 'props' para o usuário
// defineProps<{
//     user: User;
// }>();

// 4. Buscar o usuário diretamente do 'usePage()'
// O 'auth.user' é compartilhado globalmente pelo middleware HandleInertiaRequests.php
const page = usePage();
const user = computed(() => page.props.auth.user as User);

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-surface border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-text-primary" />
                                </Link>
                            </div>
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <button @click="toggleDarkMode"
                                class="p-2 rounded-full text-text-secondary hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <!-- Ícone de Sol (Modo Claro) -->
                                <svg v-if="isDarkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l-.707.707M12 18.364V5.636a6.364 6.364 0 1012.728 0V18.364a6.364 6.364 0 10-12.728 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l-.707.707" />
                                </svg>
                                <!-- Ícone de Lua (Modo Escuro) -->
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9 9 0 008.354-5.646z" />
                                </svg>
                            </button>
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <!-- Agora 'user' é um 'computed' e sempre deve estar disponível -->
                                                {{ user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <!-- BOTÃO HAMBURGUER REMOVIDO DAQUI -->
                        <!-- <div class="-mr-2 flex items-center sm:hidden"> ... </div> -->
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <!-- MENU RESPONSIVO SUPERIOR REMOVIDO DAQUI -->
                <!-- <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden"> ... </div> -->
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <!-- Adicionado padding-bottom (pb-20) para não sobrepor o conteúdo -->
            <main class="pb-20 sm:pb-0">
                <slot />
            </main>
        </div>

        <!-- Mobile Bottom Navigation -->
        <!-- Adicionado o novo menu aqui, visível apenas em telas pequenas (sm:hidden) -->
        <MobileBottomNav class="sm:hidden" />
    </div>
</template>
