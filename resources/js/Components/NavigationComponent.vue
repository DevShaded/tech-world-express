<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ComputedRef } from "vue";

const page = usePage();
const appUrl: ComputedRef<string> = computed(() => page.props.app.url);

const navigation = [
    {
        name: 'Profile',
        href: route('profile.edit'),
        current: (appUrl.value + page.url) === route('profile.edit')
    },
    {
        name: 'Information',
        href: route('information.index'),
        current: (appUrl.value + page.url) === route('information.index')
    },
    {
        name: 'Billing',
        href: route('billing.index'),
        current: (appUrl.value + page.url) === route('billing.index')
    },
    {name: 'Orders', href: '#', current: false},
];
</script>

<template>
    <header class="border-b border-white/5">
        <nav class="flex overflow-x-auto py-4">
            <ul
                role="list"
                class="flex min-w-full flex-none gap-x-6 px-4 text-sm font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8">
                <li v-for="item in navigation" :key="item.name">
                    <Link :href="item.href" :class="item.current ? 'text-indigo-400' : ''">{{
                            item.name
                        }}
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style scoped>

</style>
