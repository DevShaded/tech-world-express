<script lang="ts" setup>
import { Cart, CartType } from "@/types/CartType";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import { LockClosedIcon, TrashIcon } from "@heroicons/vue/20/solid";
import { computed, ComputedRef } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { CheckoutUserType } from "@/types/CheckoutUserType";
import InputError from "@/Components/InputError.vue";
import CartEmpty from "@/Components/CartEmpty.vue";
import { User } from "@/types";

const props = defineProps<{
    data: {
        user: CheckoutUserType;
        countries: {
            id: number;
            name: string;
        }[];
        cart: Cart;
        price: {
            subtotal: string;
            tax: string;
            total: string;
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

const user: ComputedRef<User> = computed((): User => {
    return usePage().props.auth.user;
});

const form = useForm({
    content_list: contentList.value,
    user_id: user.value.id,
    email: props.data.user.email ?? null,
    first_name: props.data.user.user_information?.first_name ?? null,
    last_name: props.data.user.user_information?.first_name ?? null,
    company_name: props.data.user.user_information?.company_name ?? null,
    address: props.data.user.user_information?.address ?? null,
    address2: props.data.user.user_information?.address2 ?? null,
    city: props.data.user.user_information?.city ?? null,
    country: props.data.user.user_information?.country?.name ?? null,
    state_province: props.data.user.user_information?.state_province ?? null,
    zip_postal_code: props.data.user.user_information?.zip_postal_code ?? null,
    phone: props.data.user.user_information?.phone ?? null,
    card_number: null,
    card_name: null,
    card_expiry: null,
    card_cvv: null,
});

const submit = () => {
    form.post(route("checkout.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <DefaultLayout title="Checkout" content="Seamless Checkout Process - Securely Complete Your Purchase Today" :url="usePage().url">
        <div class="bg-gray-50">
            <div
                class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8"
            >
                <h2 class="sr-only">Checkout</h2>

                <div v-if="contentList.length">
                    <form
                        class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16"
                        @submit.prevent="submit"
                    >
                        <div>
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Contact information
                                </h2>

                                <div class="mt-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700"
                                        for="email-address"
                                        >Email address</label
                                    >
                                    <div class="mt-1">
                                        <input
                                            id="email-address"
                                            v-model="form.email"
                                            autocomplete="email"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            name="email-address"
                                            type="email"
                                        />
                                    </div>

                                    <InputError
                                        :message="form.errors.email"
                                        class="mt-2"
                                    />
                                </div>
                            </div>

                            <div class="mt-10 border-t border-gray-200 pt-10">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Shipping information
                                </h2>

                                <div
                                    class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4"
                                >
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="first-name"
                                            >First name</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="first-name"
                                                v-model="form.first_name"
                                                autocomplete="given-name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="first-name"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.first_name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="last-name"
                                            >Last name</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="last-name"
                                                v-model="form.last_name"
                                                autocomplete="family-name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="last-name"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.last_name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="company"
                                            >Company</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="company"
                                                v-model="form.company_name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="company"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.company_name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="address"
                                            >Address</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="address"
                                                v-model="form.address"
                                                autocomplete="street-address"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="address"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.address"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="apartment"
                                            >Apartment, suite, etc.</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="apartment"
                                                v-model="form.address2"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="apartment"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.address2"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="city"
                                            >City</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="city"
                                                v-model="form.city"
                                                autocomplete="address-level2"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="city"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.city"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="country"
                                            >Country</label
                                        >
                                        <div class="mt-1">
                                            <select
                                                id="country"
                                                v-model="form.country"
                                                autocomplete="country-name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="country"
                                            >
                                                <option
                                                    v-for="country in props.data
                                                        .countries"
                                                    :key="country.id"
                                                >
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <InputError
                                            :message="form.errors.country"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="region"
                                            >State / Province</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="region"
                                                v-model="form.state_province"
                                                autocomplete="address-level1"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="region"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="
                                                form.errors.state_province
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="postal-code"
                                            >Postal code</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="postal-code"
                                                v-model="form.zip_postal_code"
                                                autocomplete="postal-code"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="postal-code"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="
                                                form.errors.zip_postal_code
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="phone"
                                            >Phone</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="phone"
                                                v-model="form.phone"
                                                autocomplete="tel"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="phone"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.phone"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="mt-10 border-t border-gray-200 pt-10">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Payment
                                </h2>

                                <div
                                    class="mt-6 grid grid-cols-4 gap-x-4 gap-y-6"
                                >
                                    <div class="col-span-4">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="card-number"
                                            >Card number</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="card-number"
                                                v-model="form.card_number"
                                                autocomplete="cc-number"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="card-number"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.card_number"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-4">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="name-on-card"
                                            >Name on card</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="name-on-card"
                                                v-model="form.card_name"
                                                autocomplete="cc-name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="name-on-card"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.card_name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-3">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="expiration-date"
                                            >Expiration date (MM/YY)</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="expiration-date"
                                                v-model="form.card_expiry"
                                                autocomplete="cc-exp"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="expiration-date"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.card_expiry"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            for="cvc"
                                            >CVV</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                id="cvc"
                                                v-model="form.card_cvv"
                                                autocomplete="csc"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                name="cvc"
                                                type="text"
                                            />
                                        </div>

                                        <InputError
                                            :message="form.errors.card_cvv"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Disclamer dont use real credit card info -->
                                <div
                                    class="bg-white my-5 p-3 rounded-lg shadow outline-red-500"
                                >
                                    <div>
                                        <div
                                            class="text-red-500 text-center font-bold mb-3"
                                        >
                                            Do not use real credit card
                                            information
                                        </div>

                                        <p
                                            class="flex justify-center text-sm font-medium text-gray-500"
                                        >
                                            <LockClosedIcon
                                                aria-hidden="true"
                                                class="mr-1.5 h-5 w-5 text-gray-400"
                                            />
                                            Payment details stored in plain text
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order summary -->
                        <div class="mt-10 lg:mt-0">
                            <h2 class="text-lg font-medium text-gray-900">
                                Order summary
                            </h2>

                            <div
                                class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm"
                            >
                                <h3 class="sr-only">Items in your cart</h3>
                                <ul
                                    class="divide-y divide-gray-200"
                                    role="list"
                                >
                                    <li
                                        v-for="product in contentList"
                                        :key="product.id"
                                        class="flex px-4 py-6 sm:px-6"
                                    >
                                        <div class="flex-shrink-0">
                                            <img
                                                :alt="
                                                    product.options.product.name
                                                "
                                                :src="
                                                    product.options.product
                                                        .information
                                                        .product_information_picture
                                                        .image
                                                "
                                                class="w-20 rounded-md"
                                            />
                                        </div>

                                        <div class="ml-6 flex flex-1 flex-col">
                                            <div class="flex">
                                                <div class="min-w-0 flex-1">
                                                    <h4 class="text-sm">
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'product.show',
                                                                    {
                                                                        name: product
                                                                            .options
                                                                            .product
                                                                            .information
                                                                            .category
                                                                            .name,
                                                                        slug: product
                                                                            .options
                                                                            .product
                                                                            .slug,
                                                                    },
                                                                )
                                                            "
                                                            class="font-medium text-gray-700 hover:text-gray-800"
                                                            >{{
                                                                product.options
                                                                    .product
                                                                    .name
                                                            }}
                                                        </Link>
                                                    </h4>
                                                    <p
                                                        class="mt-1 text-sm text-gray-500"
                                                    >
                                                        {{
                                                            product.options
                                                                .product
                                                                .information
                                                                .description
                                                        }}
                                                    </p>
                                                    <p class="mt-1 text-sm">
                                                        Quantity:
                                                        {{ product.qty }}
                                                    </p>
                                                </div>

                                                <div
                                                    class="ml-4 flow-root flex-shrink-0"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'cart.destroy',
                                                                {
                                                                    cart: product.rowId,
                                                                },
                                                            )
                                                        "
                                                        as="button"
                                                        class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-red-500 hover:text-red-700"
                                                        method="delete"
                                                        type="button"
                                                    >
                                                        <span class="sr-only"
                                                            >Remove</span
                                                        >
                                                        <TrashIcon
                                                            aria-hidden="true"
                                                            class="h-5 w-5"
                                                        />
                                                    </Link>
                                                </div>
                                            </div>

                                            <div
                                                class="flex flex-1 items-end justify-between pt-2"
                                            >
                                                <p
                                                    class="mt-1 text-sm font-medium text-gray-900"
                                                >
                                                    ${{ product.price }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <dl
                                    class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6"
                                >
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <dt class="text-sm">Subtotal</dt>
                                        <dd
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            ${{ data.price.subtotal }}
                                        </dd>
                                    </div>
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <dt class="text-sm">Taxes</dt>
                                        <dd
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            ${{ data.price.tax }}
                                        </dd>
                                    </div>
                                    <div
                                        class="flex items-center justify-between border-t border-gray-200 pt-6"
                                    >
                                        <dt class="text-base font-medium">
                                            Total
                                        </dt>
                                        <dd
                                            class="text-base font-medium text-gray-900"
                                        >
                                            ${{ data.price.total }}
                                        </dd>
                                    </div>
                                </dl>

                                <div
                                    class="border-t border-gray-200 px-4 py-6 sm:px-6"
                                >
                                    <button
                                        class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                                        type="submit"
                                    >
                                        Confirm order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div v-else>
                    <CartEmpty />
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
