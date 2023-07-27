<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";

defineProps<{
    name: string;
    description: string;
    price: string;
    highlights: string;
    category: string;
}>();

const capitalize = (s: string): string => {
    return s.charAt(0).toUpperCase() + s.slice(1);
};
</script>

<template>
    <div
        class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:col-span-3 lg:row-span-2 lg:row-end-2 lg:mt-0 lg:max-w-none"
    >
        <div class="flex flex-col-reverse">
            <div>
                <h1
                    class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"
                >
                    {{ name }}
                </h1>

                <h2 id="information-heading" class="sr-only">
                    Product information
                </h2>
            </div>
        </div>

        <p class="mt-4 text-gray-500">
            {{ description }}
        </p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
            <button
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                type="button"
            >
                Pay ${{ price }}
            </button>
            <button
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-50 px-8 py-3 text-base font-medium text-indigo-700 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                type="button"
            >
                Add to cart
            </button>
        </div>

        <div class="mt-10 border-t border-gray-200 pt-10">
            <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
            <div class="prose prose-sm mt-4 text-gray-500">
                <p>
                    {{ highlights }}
                </p>
            </div>
        </div>

        <div class="mt-10 border-t border-gray-200 pt-10">
            <h3 class="text-sm font-medium text-gray-900 mb-2">Category</h3>
            <Link
                :href="
                    route('categories.show', {
                        category: category,
                    })
                "
                class="mt-4 text-sm text-gray-500 hover:text-gray-700"
            >
                {{ capitalize(category) }}
            </Link>
        </div>
    </div>
</template>

<style scoped></style>
