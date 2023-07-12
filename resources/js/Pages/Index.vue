<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import RandomProducts from "@/Components/RandomProducts.vue";
import { Product } from "@/types/ProductType";
import { Link } from "@inertiajs/vue3";

defineProps<{
    data: {
        products: Product[];
    };
}>();
</script>

<template>
    <DefaultLayout>
        <!-- Hero -->
        <div class="flex flex-col border-b border-gray-200 lg:border-0">
            <div class="relative">
                <div
                    aria-hidden="true"
                    class="absolute hidden h-full w-1/2 bg-gray-100 lg:block"
                />
                <div class="relative bg-gray-100 lg:bg-transparent">
                    <div
                        class="mx-auto max-w-7xl px-4 sm:px-6 lg:grid lg:grid-cols-2 lg:px-8"
                    >
                        <div
                            class="mx-auto max-w-2xl py-24 lg:max-w-none lg:py-64"
                        >
                            <div class="lg:pr-16">
                                <h1
                                    class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl xl:text-6xl"
                                >
                                    Tech World Express
                                </h1>
                                <p class="mt-4 text-xl text-gray-600">
                                    Your Go-To Tech Store for Global Express
                                    Delivery!
                                </p>
                                <div class="mt-6">
                                    <Link
                                        class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 font-medium text-white hover:bg-indigo-700"
                                        href="#"
                                        >Shop now!
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="h-48 w-full sm:h-64 lg:absolute lg:right-0 lg:top-0 lg:h-full lg:w-1/2"
                >
                    <img
                        alt=""
                        class="h-full w-full object-cover object-center"
                        src="https://images.unsplash.com/photo-1547394765-185e1e68f34e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                    />
                </div>
            </div>
        </div>

        <!-- Random products -->
        <RandomProducts :products="data.products" />
    </DefaultLayout>
</template>
