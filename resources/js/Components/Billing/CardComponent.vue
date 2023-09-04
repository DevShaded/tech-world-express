<script setup lang="ts">
import { DataEntity } from "@/types/BillingType";

defineProps<{
    billing: DataEntity
}>();

const maskCreditCard = (value: string) => {
    return value.replace(/\d(?=\d{4})/g, "*");
};
</script>

<template>
    <div class="flex w-full items-center justify-between space-x-6 p-6">
        <div class="flex-1 truncate">
            <div class="flex items-center space-x-3">
                <h3 class="truncate text-sm font-medium text-gray-300">{{
                        billing.card_name
                    }}</h3>
                <span
                    class="inline-flex flex-shrink-0 items-center rounded-full px-1.5 py-0.5 text-xs font-medium text-gray-500">{{
                        maskCreditCard(billing.card_number.toString())
                    }}</span>
            </div>
            <p class="mt-1 truncate text-sm text-gray-400">{{ billing.card_expiry }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
