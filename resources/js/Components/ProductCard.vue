<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { Category, Product } from "@/types/ProductType";

defineProps<{
    product: Product;
    category: Category;
}>();
</script>

<template>
    <div
        class="aspect-h-4 aspect-w-3 bg-gray-200 sm:aspect-none group-hover:opacity-75 sm:h-96"
    >
        <img
            :alt="product.name"
            :src="product.information.product_information_picture.image"
            class="h-full w-full object-cover object-center sm:h-full sm:w-full"
        />
    </div>
    <div class="flex flex-1 flex-col space-y-2 p-4">
        <h3 class="text-sm font-medium text-gray-900">
            <Link href="#">
                <span aria-hidden="true" class="absolute inset-0" />
                {{ product.name }}
            </Link>
        </h3>
        <p class="text-sm text-gray-500">
            {{ product.information.description }}
        </p>
        <div class="flex flex-1 flex-col justify-end">
            <p class="text-base font-medium text-gray-900">
                $ {{ product.information.price }}
            </p>
        </div>
    </div>
</template>

<style scoped></style>
