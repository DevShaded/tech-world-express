<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { UserInformation } from "@/types/UserInformationType";
import UpdateUserInformationForm from "./Partials/UpdateUserInformationForm.vue";

defineProps<{
    data: UserInformation;
}>();

const secondaryNavigation = [
    { name: 'Account', href: '#', current: false },
    { name: 'Information', href: '#', current: true },
    { name: 'Billing', href: '#', current: false },
    { name: 'Orders', href: '#', current: false },
]

</script>

<template>
    <AuthenticatedLayout>
            <section class="max-w-7xl mx-auto">
                <header class="border-b border-white/5">
                    <!-- Secondary navigation -->
                    <nav class="flex overflow-x-auto py-4">
                        <ul role="list" class="flex min-w-full flex-none gap-x-6 px-4 text-sm font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8">
                            <li v-for="item in secondaryNavigation" :key="item.name">
                                <a :href="item.href" :class="item.current ? 'text-indigo-400' : ''">{{ item.name }}</a>
                            </li>
                        </ul>
                    </nav>
                </header>

                <!-- Settings forms -->
                <div class="divide-y divide-white/5">
                    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
                        <div>
                            <h2 class="text-base font-semibold leading-7 text-white">Personal Information</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-400">Use a permanent address where you can receive mail.</p>
                        </div>

                      <UpdateUserInformationForm :data="data" />
                    </div>
                </div>
            </section>
    </AuthenticatedLayout>
</template>
