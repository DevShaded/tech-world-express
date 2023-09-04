<script setup lang="ts">
import { UserOrders } from "@/types/UserOrderTypes";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavigationComponent from "@/Components/NavigationComponent.vue";
import OrderContainer from "@/Components/Orders/OrderContainer.vue";
import { CursorArrowRaysIcon } from "@heroicons/vue/20/solid";

defineProps<{
    data: UserOrders;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <NavigationComponent/>

        <section class="max-w-4xl mx-auto">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Last 30 days</h3>

            <div class="mt-5 mx-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="All Orders"
                    :user-order="data.orders.all"
                    link="/orders/all"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Pending Orders"
                    :user-order="data.orders.pending"
                    link="/orders/all"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Cancelled Orders"
                    :user-order="data.orders.cancelled"
                    link="/orders/all"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Completed Orders"
                    :user-order="data.orders.completed"
                    link="/orders/all"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Processing Orders"
                    :user-order="data.orders.processing"
                    link="/orders/all"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Shipped Orders"
                    :user-order="data.orders.shipped"
                    link="/orders/all"
                />
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
