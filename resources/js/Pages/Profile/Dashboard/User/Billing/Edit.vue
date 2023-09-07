<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavigationLayout from "@/Components/NavigationComponent.vue";
import UpdateCreditCardInformation
    from "@/Pages/Profile/Dashboard/User/Billing/Partials/UpdateCreditCardInformation.vue";
</script>

<template>
    <AuthenticatedLayout title="Edit Billing">
        <section class="max-w-7xl mx-auto">
            <NavigationLayout/>

            <!-- settings forms -->
            <div class="divide-y divide-white/5">
                <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-white">Credit Card Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">This is the information for your credit
                            card.</p>
                    </div>

                    <UpdateCreditCardInformation/>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
