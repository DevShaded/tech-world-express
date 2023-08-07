<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import { Data } from "@/types/CheckoutType";
import Products from "@/Components/Checkout/Success/ProductsComponent.vue"
import BillingComponent from "@/Components/Checkout/Success/BillingComponent.vue";

const props = defineProps<{
    data: Data;
}>();

let step;

switch (props.data.order.status) {
    case "pending":
        step = 0;
        break;
    case "processing":
        step = 1;
        break;
    case "shipped":
        step = 2;
        break;
    case "completed":
        step = 3;
        break;
    case "cancelled":
        step = 4;
        break;
    default:
        step = 0;
}

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp);
    return date.toLocaleDateString("en-US", {
        month: "long",
        day: "numeric",
        year: "numeric",
    });
};
</script>

<template>
    <DefaultLayout>
        <div class="mx-auto max-w-2xl pb-24 pt-8 sm:px-6 sm:pt-16 lg:max-w-7xl lg:px-8">
            <div class="space-y-2 px-4 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 sm:px-0">
                <div class="flex sm:items-baseline sm:space-x-4">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Your order was successful!</h1>
                </div>
                <p class="text-sm text-gray-600">Order placed <time datetime="2021-03-22" class="font-medium text-gray-900">{{ timestampToDate(data.order.order_date) }}</time></p>
            </div>

            <!-- Products -->
            <section aria-labelledby="products-heading" class="mt-6">
                <h2 id="products-heading" class="sr-only">Products purchased</h2>

                <div class="space-y-8">
                    <Products :user="data.user" :order="data.order" :products="data.order.user_order_items" />
                </div>
            </section>

            <!-- Billing -->
            <BillingComponent :total-amount="data.order.total_amount" :user-billing="data.user.user_billing" :user-shipping="data.user.user_shipping" />
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
