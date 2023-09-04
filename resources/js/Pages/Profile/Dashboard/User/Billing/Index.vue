<script setup lang="ts">
import { BillingInformation } from "@/types/BillingType";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavigationLayout from "@/Components/NavigationComponent.vue";
import CardListComponent from "@/Components/Billing/CardListComponent.vue";

defineProps<{
    data: BillingInformation;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <section class="max-w-7xl mx-auto">
            <NavigationLayout/>

            <div class="mx-auto px-6 py-24 sm:py-32 lg:px-8">
                <div v-if="data.billing.data?.length > 0" class="max-w-xl mx-auto py-10">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-4xl font-bold tracking-tight text-gray-300 sm:text-6xl">My payment methods</h2>
                    </div>

                    <CardListComponent :data="data"/>
                </div>

                <div v-else>
                    <div>
                        <div class="mx-auto max-w-2xl text-center">
                            <h2 class="text-4xl font-bold tracking-tight text-gray-300 sm:text-6xl">No cards stored</h2>
                            <p class="mt-5 text-xl text-gray-400">You have no cards stored.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
