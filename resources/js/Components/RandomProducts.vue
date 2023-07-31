<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { Product } from "@/types/ProductType";

defineProps<{
    products: Product[];
}>();
</script>

<template>
    <section aria-labelledby="trending-heading" class="bg-white">
        <div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8 lg:py-32">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                <h2
                    id="trending-heading"
                    class="text-2xl font-bold tracking-tight text-gray-900"
                >
                    Some Random products for you!
                </h2>
                <Link
                    :href="route('categories.index')"
                    class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block"
                >
                    See everything
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>

            <div class="relative mt-8">
                <div class="relative w-full overflow-x-auto">
                    <ul
                        class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0"
                        role="list"
                    >
                        <li
                            v-for="product in products"
                            :key="product.id"
                            class="inline-flex w-64 flex-col text-center lg:w-auto"
                        >
                            <div class="group relative">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200"
                                >
                                    <img
                                        :alt="product.name"
                                        :src="
                                            product.information
                                                .product_information_picture
                                                .image
                                        "
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <div class="mt-6">
                                    <h3
                                        class="mt-1 font-semibold text-gray-900"
                                    >
                                        <Link
                                            :href="
                                                route('product.show', {
                                                    name: product.information
                                                        .category.name,
                                                    slug: product.slug,
                                                })
                                            "
                                        >
                                            <span class="absolute inset-0" />
                                            {{ product.name }}
                                        </Link>
                                    </h3>
                                    <p class="mt-1 text-gray-900">
                                        $ {{ product.information.price }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 px-4 sm:hidden">
                <Link
                    :href="route('categories.index')"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-500"
                >
                    See everything
                    <span aria-hidden="true"> &rarr;</span>
                </Link>
            </div>
        </div>
    </section>
</template>

<style scoped></style>
