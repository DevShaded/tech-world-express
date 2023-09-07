<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import RandomProducts from "@/Components/RandomProducts.vue";
import { Product } from "@/types/ProductType";
import { Link } from "@inertiajs/vue3";

defineProps<{
    data: {
        products: {
            data: Product[];
        };
    };
}>();

const incentives = [
    {
        name: "Free Shipping",
        description:
            "It's not actually free we just price it into the products. Someone's paying for it, and it's not us.",
        imageSrc:
            "https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg",
    },
    {
        name: "24/7 Customer Support",
        description:
            "Our AI chat widget is powered by a naive series of if/else statements just for a low price of 399$ for each message. Guaranteed to irritate.",
        imageSrc:
            "https://tailwindui.com/img/ecommerce/icons/icon-chat-light.svg",
    },
    {
        name: "Fast Shopping Cart",
        description:
            "Look how fast that cart is going. What does this mean for the actual experience? I don't know.",
        imageSrc:
            "https://tailwindui.com/img/ecommerce/icons/icon-fast-checkout-light.svg",
    },
    {
        name: "Gift Cards",
        description:
            "Buy them for your friends, especially if they don't like our store. Free money for us, it's great.",
        imageSrc:
            "https://tailwindui.com/img/ecommerce/icons/icon-gift-card-light.svg",
    },
];
</script>

<template>
    <DefaultLayout title="Home" content="Your Go-To Tech Store for Global Express Delivery!" url="/">
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
                                        :href="route('categories.index')"
                                        class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 font-medium text-white hover:bg-indigo-700"
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
        <RandomProducts :products="data.products.data" />

        <!-- Incentives -->
        <section class="bg-gray-50">
            <div
                class="mx-auto max-w-2xl px-4 py-24 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
            >
                <h2
                    class="text-4xl font-extrabold tracking-tight text-gray-900 text-center pb-12"
                >
                    Our Incentives
                </h2>
                <div
                    class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8"
                >
                    <div v-for="incentive in incentives" :key="incentive.name">
                        <img
                            :src="incentive.imageSrc"
                            alt=""
                            class="h-24 w-auto"
                        />
                        <h3 class="mt-6 text-sm font-medium text-gray-900">
                            {{ incentive.name }}
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ incentive.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured section -->
        <section class="bg-white">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
                <div class="relative overflow-hidden rounded-lg">
                    <div class="absolute inset-0">
                        <img
                            alt=""
                            class="h-full w-full object-cover object-center"
                            src="https://tailwindui.com/img/ecommerce-images/home-page-01-feature-section-01.jpg"
                        />
                    </div>
                    <div
                        class="relative bg-gray-900 bg-opacity-75 px-6 py-32 sm:px-12 sm:py-40 lg:px-16"
                    >
                        <div
                            class="relative mx-auto flex max-w-3xl flex-col items-center text-center"
                        >
                            <h2
                                class="text-3xl font-bold tracking-tight text-white sm:text-4xl"
                            >
                                <span class="block sm:inline">Level up</span>
                                <span class="block sm:inline">your desk</span>
                            </h2>
                            <p class="mt-3 text-xl text-white">
                                Make your computer beautiful and organized. Post
                                a picture to social media and watch it get more
                                likes than life-changing announcements. Reflect
                                on the shallow nature of existence. At least you
                                have a really nice desk setup.
                            </p>
                            <Link
                                :href="route('categories.index')"
                                class="mt-8 block w-full rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto"
                                >Shop Workspace!
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
