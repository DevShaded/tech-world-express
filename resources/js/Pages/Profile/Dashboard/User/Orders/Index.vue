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
    <AuthenticatedLayout title="Orders">
        <NavigationComponent/>

        <section class="max-w-4xl mx-auto">
            <div class="mt-5 mx-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="All Orders"
                    :user-order="data.orders.all"
                    :link="route('orders.show', { status: 'all' })"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Pending Orders"
                    :user-order="data.orders.pending"
                    :link="route('orders.show', { status: 'pending' })"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Cancelled Orders"
                    :user-order="data.orders.cancelled"
                    :link="route('orders.show', { status: 'cancelled' })"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Completed Orders"
                    :user-order="data.orders.completed"
                    :link="route('orders.show', { status: 'completed' })"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Processing Orders"
                    :user-order="data.orders.processing"
                    :link="route('orders.show', { status: 'processing' })"
                />

                <OrderContainer
                    :icon="CursorArrowRaysIcon"
                    entity="Shipped Orders"
                    :user-order="data.orders.shipped"
                    :link="route('orders.show', { status: 'shipped' })"
                />
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
