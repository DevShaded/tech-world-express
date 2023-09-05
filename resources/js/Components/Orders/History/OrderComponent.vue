<script setup lang="ts">
import { UserOrdersEntity } from "@/types/OrdersType";

defineProps<{
    userOrder: UserOrdersEntity
}>();

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp);
    return date.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
};
</script>

<template>
    <div
        class="flex items-center border-b border-gray-600 p-4 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:p-6">
        <dl class="grid flex-1 grid-cols-2 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-2">
            <div>
                <dt class="font-medium text-gray-300">Order number</dt>
                <dd class="mt-1 text-gray-400">{{ userOrder.id }}</dd>
            </div>
            <div class="hidden sm:block">
                <dt class="font-medium text-gray-300">Date placed</dt>
                <dd class="mt-1 text-gray-400">
                    <time :datetime="timestampToDate(userOrder.order_date)">{{
                            timestampToDate(userOrder.order_date)
                        }}
                    </time>
                </dd>
            </div>
            <div>
                <dt class="font-medium text-gray-300">Total amount</dt>
                <dd class="mt-1 font-medium text-gray-300">${{
                        userOrder.total_amount
                    }}
                </dd>
            </div>
        </dl>
    </div>
</template>

<style scoped>

</style>
