<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import { Category, Product } from "@/types/ProductType";
import ProductList from "@/Components/ProductList.vue";
import { usePage } from "@inertiajs/vue3";

defineProps<{
    data: {
        products: {
            data: Product[];
        };
        category: Category;
    };
}>();
</script>

<template>
    <DefaultLayout :title="data.category.name" :content="'Products under ' + data.category.name + ' category'" :url="usePage().url">
        <div
            class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
        >
            <h2 class="text-2xl pb-4">
                Products under {{ data.category.name }} category
            </h2>

            <ProductList
                v-if="data.products.data.length > 0"
                :category="data.category"
                :products="data.products.data"
            />

            <div v-else>
                <p>No products found under this category :(</p>
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
