<script setup lang="ts">
import { OrdersType } from "@/types/OrdersType";
import OrderComponent from "@/Components/Orders/History/OrderComponent.vue";
import ProductComponent from "@/Components/Orders/History/ProductComponent.vue";

const props = defineProps<{
    status: string;
    data: OrdersType;
}>();

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp);
    return date.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
};

let statusTitle: string;
let statusSentence: string;

switch (props.status) {
    case "all":
        statusTitle = "All Orders";
        statusSentence = "All Orders";
        break;
    case "pending":
        statusTitle = "Pending Orders";
        statusSentence = "Order is Pending";
        break;
    case "processing":
        statusTitle = "Processing Orders";
        statusSentence = "Order is Processing";
        break;
    case "shipped":
        statusTitle = "Shipped Orders";
        statusSentence = "Order is Shipped";
        break;
    case "completed":
        statusTitle = "Completed Orders";
        statusSentence = "Order is Completed";
        break;
    case "cancelled":
        statusTitle = "Cancelled Orders";
        statusSentence = "Order is Cancelled";
        break;
    default:
        statusTitle = "All Orders";
        statusSentence = "All";
        break;
}
</script>

<template>
    <div v-for="order in data.orders" :key="order.id">
        <div
            v-for="userOrder in order.user_orders" :key="userOrder.id"
            class="bg-gray-800 mb-10 shadow-sm sm:rounded-lg">
            <h3 class="sr-only">
                Order placed on
                <time :datetime="timestampToDate(userOrder.order_date)">
                    {{ timestampToDate(userOrder.order_date) }}
                </time>
            </h3>

            <OrderComponent :user-order="userOrder"/>

            <!-- Products -->
            <div v-for="product in userOrder.user_order_items" :key="product.id">
                <ProductComponent :product="product" :status="status"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
