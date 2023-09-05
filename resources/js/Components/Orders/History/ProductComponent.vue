<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { UserOrderItemsEntity } from "@/types/OrdersType";

const props = defineProps<{
    status: string;
    product: UserOrderItemsEntity
}>();

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
    <h4 class="sr-only">Items</h4>
    <ul role="list" class="divide-y divide-gray-200">
        <li
            class="p-4 sm:p-6">
            <div class="flex items-center sm:items-start">
                <div
                    class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-200 sm:h-40 sm:w-40">
                    <img
                        :src="product.product.information.product_information_picture.image"
                        :alt="product.product.name"
                        class="h-full w-full object-cover object-center"/>
                </div>
                <div class="ml-6 flex-1 text-sm">
                    <div class="font-medium text-gray-300 sm:flex sm:justify-between">
                        <h5>{{ product.product.name }}</h5>
                        <p class="mt-2 sm:mt-0">${{ product.product.information.price }}</p>
                    </div>
                    <p class="hidden text-gray-400 sm:mt-2 sm:block w-1/2">{{
                            product.product.information.description
                        }}</p>
                </div>
            </div>

            <div class="mt-6 sm:flex sm:justify-between">
                <div class="flex items-center">
                    <p class="ml-2 text-sm font-medium text-gray-300">
                        <span class="text-gray-400">{{ statusSentence }}</span>
                    </p>
                </div>

                <div
                    class="mt-6 flex items-center space-x-4 divide-x divide-gray-200 border-t border-gray-200 pt-4 text-sm font-medium sm:ml-4 sm:mt-0 sm:border-none sm:pt-0">
                    <div class="flex flex-1 justify-center">
                        <Link
                            :href="route('product.show', { name: product.product.information.category.name, slug: product.product.slug })"
                            class="whitespace-nowrap text-indigo-400 hover:text-indigo-500">
                            View
                            product
                        </Link>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<style scoped>

</style>
