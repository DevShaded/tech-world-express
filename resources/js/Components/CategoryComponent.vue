<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { Category } from "@/types/ProductType";

defineProps<{
    category: Category;
}>();

const capitalize = (s: string): string => {
    return s.charAt(0).toUpperCase() + s.slice(1);
};
</script>

<template>
    <div class="bg-white shadow rounded">
        <Link
            :href="
                route('categories.show', {
                    category: category.name,
                })
            "
        >
            <div
                class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"
            >
                <img
                    :alt="category.name"
                    class="pointer-events-none object-cover group-hover:opacity-75"
                    src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=512&q=80"
                />
                <button
                    class="absolute inset-0 focus:outline-none"
                    type="button"
                >
                    <span class="sr-only"
                        >View products in the
                        {{ capitalize(category.name) }} category</span
                    >
                </button>
            </div>
            <div class="pl-3 my-5">
                <p
                    class="pointer-events-none py-2 block truncate font-medium text-gray-900"
                >
                    {{ capitalize(category.name) }}
                </p>
            </div>
        </Link>
    </div>
</template>

<style scoped></style>
