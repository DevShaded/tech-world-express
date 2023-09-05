<script setup lang="ts">
import {
    AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity
} from "@/types/UserOrderTypes";
import { Link } from "@inertiajs/vue3";
import { FunctionalComponent, HTMLAttributes, VNodeProps } from "vue";

defineProps<{
    icon: FunctionalComponent<HTMLAttributes & VNodeProps>;
    entity: string;
    userOrder: AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity[] | null | undefined;
    link: string;
}>();
</script>

<template>
    <article
        class="relative overflow-hidden rounded-lg bg-gray-800 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
        <div>
            <div class="absolute rounded-md bg-indigo-500 p-3">
                <component :is="icon" class="h-6 w-6 text-white" aria-hidden="true"/>
            </div>
            <p class="ml-16 truncate text-sm font-medium text-gray-400">{{ entity }}</p>
        </div>
        <div class="ml-16 flex items-baseline pb-6 sm:pb-7">
            <p class="text-2xl font-semibold text-gray-300">
                {{ userOrder[0]?.user_orders ? userOrder[0]?.user_orders.length : 0 }}
                total orders</p>
            <div class="absolute bg-gray-800 inset-x-0 bottom-0 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <Link :href="link" class="font-medium text-indigo-600 hover:text-indigo-500">
                        View all
                    </Link>
                </div>
            </div>
        </div>
    </article>
</template>

<style scoped>

</style>
