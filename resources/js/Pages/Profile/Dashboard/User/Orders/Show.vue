<script setup lang="ts">
import { OrdersType } from "@/types/OrdersType";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavigationComponent from "@/Components/NavigationComponent.vue";
import OrdersList from "@/Components/Orders/History/OrdersList.vue";

const props = defineProps<{
    status: string;
    data: OrdersType;
}>();

let statusTitle: string;

switch (props.status) {
    case "all":
        statusTitle = "All Orders";
        break;
    case "pending":
        statusTitle = "Pending Orders";
        break;
    case "processing":
        statusTitle = "Processing Orders";
        break;
    case "shipped":
        statusTitle = "Shipped Orders";
        break;
    case "completed":
        statusTitle = "Completed Orders";
        break;
    case "cancelled":
        statusTitle = "Cancelled Orders";
        break;
    default:
        statusTitle = "All Orders";
        break;
}
</script>

<template>
    <AuthenticatedLayout>
        <NavigationComponent/>

        <section class="py-24">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-0">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-300 sm:text-3xl">{{ statusTitle }}</h1>
                    <p class="mt-2 text-sm text-gray-400">Check the status of your orders!</p>
                </div>
            </div>

            <section aria-labelledby="recent-heading" class="mt-16">
                <h2 id="pending-heading" class="sr-only">Pending orders</h2>
                <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                    <div class="mx-auto max-w-2xl space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
                        <OrdersList :data="data" :status="status"/>
                    </div>
                </div>
            </section>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>.
