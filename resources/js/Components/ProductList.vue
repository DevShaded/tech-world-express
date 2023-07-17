<script lang="ts" setup>
import { Category, Product } from "@/types/ProductType";
import ProductCard from "@/Components/ProductCard.vue";

defineProps<{
    products: Product[];
    category: Category;
}>();
</script>

<template>
    <div
        class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:grid-cols-3 lg:gap-x-8"
    >
        <div
            v-for="product in products"
            :key="product.id"
            class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white"
        >
            <ProductCard :category="category" :product="product" />
        </div>
    </div>
</template>

<style scoped></style>
