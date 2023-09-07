<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { UserInformation } from "@/types/UserInformationType";
import UpdateUserInformationForm from "./Partials/UpdateUserInformationForm.vue";
import NavigationLayout from "@/Components/NavigationComponent.vue";

defineProps<{
    data: UserInformation;
}>();
</script>

<template>
    <AuthenticatedLayout title="Information">
        <section class="max-w-7xl mx-auto">
            <NavigationLayout/>

            <!-- settings forms -->
            <div class="divide-y divide-white/5">
                <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-white">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">Use a permanent address where you can
                            receive
                            mail.</p>
                    </div>

                    <UpdateUserInformationForm :data="data"/>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
