<script setup lang="ts">
import { BillingInformation } from "@/types/BillingType";
import CardDeleteComponent from "@/Components/Billing/CardDeleteComponent.vue";
import CardEditComponent from "@/Components/Billing/CardEditComponent.vue";
import CardComponent from "@/Components/Billing/CardComponent.vue";

defineProps<{
    data: BillingInformation;
}>();
</script>

<template>
    <ul role="list" class="grid grid-cols-1 my-5">
        <li
            v-for="billing in data.billing.data" :key="billing.id"
            class="col-span-1 divide-y divide-gray-100 rounded-lg bg-gray-800 shadow">
            <CardComponent :billing="billing"/>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="flex w-0 flex-1">
                        <CardDeleteComponent :id="billing.id"/>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <CardEditComponent/>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<style scoped>

</style>
