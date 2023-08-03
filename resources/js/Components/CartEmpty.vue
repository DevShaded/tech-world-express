<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="grid min-h-full place-items-center px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-indigo-600">Not again...</p>
            <h1
                class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"
            >
                Your cart is empty!
            </h1>
            <p class="mt-6 text-base leading-7 text-gray-600">
                Time to fill it up again!
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link
                    :href="route('categories.index')"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >Go to products
                </Link>
                <Link
                    :href="route('index')"
                    class="text-sm font-semibold text-gray-900"
                    >Or go back to the home
                    <span aria-hidden="true">&rarr;</span></Link
                >
            </div>
        </div>
    </div>
</template>

<style scoped></style>
