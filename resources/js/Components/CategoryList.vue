<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { Category } from "@/types/ProductType";
import CategoryComponent from "@/Components/CategoryComponent.vue";

defineProps<{
    categories: Category[];
}>();
</script>

<template>
    <ul
        class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8"
        role="list"
    >
        <li v-for="category in categories" :key="category.id" class="relative">
            <div class="bg-white shadow-md rounded">
                <Link
                    :href="
                        route('categories.show', {
                            category: category.name,
                        })
                    "
                >
                    <CategoryComponent :category="category" />
                </Link>
            </div>
        </li>
    </ul>
</template>

<style scoped></style>
