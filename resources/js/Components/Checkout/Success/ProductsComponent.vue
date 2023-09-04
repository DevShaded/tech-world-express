<script lang="ts" setup>
import { Order, User, UserOrderItemsEntity } from "@/types/CheckoutType";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    order: Order;
    products: UserOrderItemsEntity[] | null | undefined;
    user: User;
}>();

let step;

switch (props.order.status) {
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
    <div
        v-for="product in products" :key="product.id"
        class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border">
        <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:p-8">
            <div class="sm:flex lg:col-span-7">
                <div
                    class="aspect-h-1 aspect-w-1 w-full flex-shrink-0 overflow-hidden rounded-lg sm:aspect-none sm:h-40 sm:w-40">
                    <img
                        :src="product.product.information.product_information_picture.image"
                        :alt="product.product.name"
                        class="h-full w-full object-cover object-center sm:h-full sm:w-full"/>
                </div>

                <div class="mt-6 sm:ml-6 sm:mt-0">
                    <h3 class="text-base font-medium text-gray-900">
                        <Link
                            :href="route('product.show', { name: product.product.information.category.name, slug: product.product.slug })">
                            {{ product.product.name }}
                        </Link>
                    </h3>
                    <p class="mt-2 text-sm font-medium text-gray-900">${{ product.product.information.price }}</p>
                    <p class="mt-3 text-sm text-gray-500">{{ product.product.information.description }}</p>
                </div>
            </div>

            <div class="mt-6 lg:col-span-5 lg:mt-0">
                <dl class="grid grid-cols-2 gap-x-6 text-sm">
                    <div>
                        <dt class="font-medium text-gray-900">Delivery address</dt>
                        <dd class="mt-3 text-gray-500">
                            <span class="block">{{ user.user_shipping?.shipping_address }}</span>
                            <span class="block">{{
                                    user.user_shipping?.shipping_city
                                }}, {{ user.user_shipping?.shipping_state_province }}</span>
                            <span class="block">{{ user.user_shipping?.shipping_country }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-900">Shipping updates</dt>
                        <dd class="mt-3 space-y-3 text-gray-500">
                            <p>{{ user.email }}</p>
                            <p>{{ user.user_information.phone }}</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="border-t border-gray-200 px-4 py-6 sm:px-6 lg:p-8">
            <h4 class="sr-only">Status</h4>
            <p class="text-sm font-medium text-gray-900">
                <time :datetime="timestampToDate(order.order_date)">{{ timestampToDate(order.order_date) }}</time>
            </p>
            <div class="mt-6" aria-hidden="true">
                <div class="overflow-hidden rounded-full bg-gray-200">
                    <div
                        class="h-2 rounded-full bg-indigo-600"
                        :style="{ width: `calc((${step} * 2 + 1) / 8 * 100%)` }"/>
                </div>
                <div class="mt-6 hidden grid-cols-4 text-sm font-medium text-gray-600 sm:grid">
                    <div :class="[step > 0 ? 'text-indigo-600' : '', 'text-center']">Pending</div>
                    <div :class="[step > 1 ? 'text-indigo-600' : '', 'text-center']">Processing</div>
                    <div :class="[step > 1 ? 'text-indigo-600' : '', 'text-center']">Shipped</div>
                    <div :class="[step > 2 ? 'text-indigo-600' : '', 'text-right']">Delivered</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
