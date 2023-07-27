<script lang="ts" setup>
import { Product } from "@/types/ProductType";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import ProductComponent from "@/Components/Product/ProductComponent.vue";

defineProps<{
    data: {
        product: {
            data: Product[];
        };
    };
}>();
</script>

<template>
    <DefaultLayout>
        <div class="bg-white">
            <div
                class="mx-auto px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
            >
                <!-- Product -->
                <ProductComponent :product="data.product.data[0]" />
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
