<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import { computed } from "vue";
import { Cart, CartType } from "@/types/CartType";
import { XMarkIcon as XMarkIconMini } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import { Product } from "@/types/ProductType";
import RandomProducts from "@/Components/RandomProducts.vue";

const props = defineProps<{
    data: {
        cart: Cart;
        price: {
            subtotal: string;
            tax: string;
            total: string;
        };
        randomProducts: {
            data: Product[];
        };
    };
}>();

const contentList = computed(() => {
    return Object.keys(props.data.cart).map((key) => {
        return {
            ...(props.data.cart[key] as CartType),
        };
    });
});
</script>

<template>
    <DefaultLayout>
        <main
            class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8"
        >
            <h1
                class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
            >
                Shopping Cart
            </h1>

            <div
                v-if="contentList.length"
                class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16"
            >
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">
                        Items in your shopping cart
                    </h2>

                    <ul
                        class="divide-y divide-gray-200 border-b border-t border-gray-200"
                        role="list"
                    >
                        <li
                            v-for="product in contentList"
                            :key="product.id"
                            class="flex py-6 sm:py-10"
                        >
                            <div class="flex-shrink-0">
                                <img
                                    :alt="product.name"
                                    :src="
                                        product.options.product.information
                                            .product_information_picture.image
                                    "
                                    class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
                                />
                            </div>

                            <div
                                class="ml-4 flex flex-1 flex-col justify-between sm:ml-6"
                            >
                                <div
                                    class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0"
                                >
                                    <div>
                                        <div class="flex justify-between">
                                            <h3 class="text-sm">
                                                <Link
                                                    :href="
                                                        route('product.show', {
                                                            name: product
                                                                .options.product
                                                                .information
                                                                .category.name,
                                                            slug: product
                                                                .options.product
                                                                .slug,
                                                        })
                                                    "
                                                    class="font-medium text-gray-700 hover:text-gray-800"
                                                    >{{ product.name }}
                                                </Link>
                                            </h3>
                                        </div>
                                        <p class="my-3 text-sm">
                                            {{
                                                product.options.product
                                                    .information.description
                                            }}
                                        </p>
                                        <p
                                            class="mt-1 text-sm font-medium text-gray-900"
                                        >
                                            $ {{ product.price }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="">Quantity: </span>
                                            <span> {{ product.qty }}</span>
                                        </p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:pr-9">
                                        <div class="absolute right-0 top-0">
                                            <Link
                                                :href="
                                                    route('cart.destroy', {
                                                        id: product.rowId,
                                                    })
                                                "
                                                as="button"
                                                class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                                                method="delete"
                                                type="button"
                                            >
                                                <span class="sr-only"
                                                    >Remove</span
                                                >
                                                <XMarkIconMini
                                                    aria-hidden="true"
                                                    class="h-5 w-5"
                                                />
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>

                <!-- Order summary -->
                <section
                    aria-labelledby="summary-heading"
                    class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8"
                >
                    <h2
                        id="summary-heading"
                        class="text-lg font-medium text-gray-900"
                    >
                        Order summary
                    </h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                $ {{ data.price.subtotal }}
                            </dd>
                        </div>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 pt-4"
                        >
                            <dt class="flex text-sm text-gray-600">
                                <span>Tax estimate</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">
                                $ {{ data.price.tax }}
                            </dd>
                        </div>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 pt-4"
                        >
                            <dt class="text-base font-medium text-gray-900">
                                Order total
                            </dt>
                            <dd class="text-base font-medium text-gray-900">
                                $ {{ data.price.total }}
                            </dd>
                        </div>
                    </dl>

                    <div class="text-center">
                        <Link
                            class="mt-6 w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                            href="#"
                            type="submit"
                        >
                            Checkout
                        </Link>
                    </div>
                </section>
            </div>

            <div v-else>
                <h2 class="text-lg font-medium text-gray-900 mt-4">
                    Your cart is empty :(
                </h2>

                <div class="mt-10">
                    <RandomProducts :products="data.randomProducts.data" />
                </div>
            </div>
        </main>
    </DefaultLayout>
</template>

<style scoped></style>
