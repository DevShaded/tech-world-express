<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed, ComputedRef } from "vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const page = usePage();
const appUrl: ComputedRef<string> = computed(() => page.props.app.url);

const secondaryNavigation = [
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
    {name: 'Billing', href: '#', current: false},
    {name: 'Orders', href: '#', current: false},
];
</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <section class="max-w-7xl mx-auto">
            <header class="border-b border-white/5">
                <!-- Secondary navigation -->
                <nav class="flex overflow-x-auto py-4">
                    <ul
                        role="list"
                        class="flex min-w-full flex-none gap-x-6 px-4 text-sm font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8">
                        <li v-for="item in secondaryNavigation" :key="item.name">
                            <Link :href="item.href" :class="item.current ? 'text-indigo-400' : ''">{{
                                    item.name
                                }}
                            </Link>
                        </li>
                    </ul>
                </nav>
            </header>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <UpdatePasswordForm class="max-w-xl"/>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <DeleteUserForm class="max-w-xl"/>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
