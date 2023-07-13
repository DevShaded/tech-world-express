<script lang="ts" setup>
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    ShoppingCartIcon,
    UserIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline/index.js";
import { computed, ComputedRef, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import FooterComponent from "@/Components/FooterComponent.vue";
import { User } from "@/types";

interface CategoriesEntity {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}

const user: ComputedRef<User> = computed((): User => {
    return usePage().props.auth.user;
});

const categories: ComputedRef<CategoriesEntity[] | null | unknown> = computed(
    (): CategoriesEntity[] | null | unknown => {
        return usePage().props.categories.data;
    },
);

// make first letter in category name uppercase
const capitalize = (s: string): string => {
    return s.charAt(0).toUpperCase() + s.slice(1);
};

const navigation = {
    pages: [
        { name: "Company", href: "#" },
        { name: "Stores", href: "#" },
    ],
};

const mobileMenuOpen = ref(false);
</script>

<template>
    <div class="bg-white min-h-screen">
        <TransitionRoot :show="mobileMenuOpen" as="template">
            <Dialog
                as="div"
                class="relative z-40 lg:hidden"
                @close="mobileMenuOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl"
                        >
                            <div class="flex px-4 pb-2 pt-5">
                                <button
                                    class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400"
                                    type="button"
                                    @click="mobileMenuOpen = false"
                                >
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon
                                        aria-hidden="true"
                                        class="h-6 w-6"
                                    />
                                </button>
                            </div>

                            <!-- Links -->
                            <div class="mt-2">
                                <div>
                                    <div class="space-y-12 px-4 pb-6 pt-10">
                                        <div
                                            class="grid grid-cols-1 items-start gap-x-6 gap-y-10"
                                        >
                                            <div
                                                class="grid grid-cols-1 gap-x-6 gap-y-10"
                                            >
                                                <div>
                                                    <p
                                                        id="mobile-categories-heading"
                                                        class="font-medium text-gray-900"
                                                    >
                                                        Categories
                                                    </p>
                                                    <ul
                                                        v-for="category in categories"
                                                        :key="category.id"
                                                        aria-labelledby="mobile-categories-heading"
                                                        class="mt-6 space-y-6"
                                                        role="list"
                                                    >
                                                        <li class="flex">
                                                            <Link
                                                                :href="
                                                                    route(
                                                                        'categories.show',
                                                                        category.name,
                                                                    )
                                                                "
                                                                class="text-gray-500"
                                                            >
                                                                {{
                                                                    capitalize(
                                                                        category.name,
                                                                    )
                                                                }}
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="space-y-6 border-t border-gray-200 px-4 py-6"
                            >
                                <div
                                    v-for="page in navigation.pages"
                                    :key="page.name"
                                    class="flow-root"
                                >
                                    <Link
                                        :href="page.href"
                                        class="-m-2 block p-2 font-medium text-gray-900"
                                    >
                                        {{ page.name }}
                                    </Link>
                                </div>
                            </div>

                            <div
                                v-if="!user"
                                class="space-y-6 border-t border-gray-200 px-4 py-6"
                            >
                                <div class="flow-root">
                                    <Link
                                        :href="route('register')"
                                        class="-m-2 block p-2 font-medium text-gray-900"
                                    >
                                        Create an account
                                    </Link>
                                </div>
                                <div class="flow-root">
                                    <Link
                                        :href="route('login')"
                                        class="-m-2 block p-2 font-medium text-gray-900"
                                        >Sign in
                                    </Link>
                                </div>
                            </div>

                            <div
                                v-else
                                class="space-y-6 border-t border-gray-200 px-4 py-6"
                            >
                                <div class="flow-root">
                                    <Link
                                        :href="route('dashboard')"
                                        class="-m-2 block p-2 font-medium text-gray-900"
                                    >
                                        Dashboard
                                    </Link>
                                </div>
                                <div class="flow-root">
                                    <Link
                                        :href="route('logout')"
                                        as="button"
                                        class="-m-2 block p-2 font-medium text-gray-900"
                                        method="post"
                                        type="button"
                                        >Sign out
                                    </Link>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative z-10">
            <nav aria-label="Top">
                <!-- Top navigation -->
                <div v-if="!user" class="bg-gray-900">
                    <div
                        class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8"
                    >
                        <div
                            class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6"
                        >
                            <Link
                                :href="route('register')"
                                class="text-sm font-medium text-white hover:text-gray-100"
                            >
                                Create an account
                            </Link>
                            <span
                                aria-hidden="true"
                                class="h-6 w-px bg-gray-600"
                            />
                            <Link
                                :href="route('login')"
                                class="text-sm font-medium text-white hover:text-gray-100"
                                >Sign in
                            </Link>
                        </div>
                    </div>
                </div>

                <div v-else class="bg-gray-900">
                    <div
                        class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8"
                    >
                        <div
                            class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6"
                        >
                            <Link
                                :href="route('dashboard')"
                                class="text-sm font-medium text-white hover:text-gray-100"
                            >
                                Dashboard
                            </Link>
                            <span
                                aria-hidden="true"
                                class="h-6 w-px bg-gray-600"
                            />
                            <Link
                                :href="route('logout')"
                                as="button"
                                class="text-sm font-medium text-white hover:text-gray-100"
                                method="post"
                                type="button"
                                >Sign out
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Secondary navigation -->
                <div class="bg-white">
                    <div class="border-b border-gray-200">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div class="flex h-16 items-center justify-between">
                                <!-- Logo (lg+) -->
                                <div class="hidden lg:flex lg:items-center">
                                    <Link :href="route('index')">
                                        <span class="sr-only"
                                            >Tech World Express</span
                                        >
                                        <img
                                            alt=""
                                            class="h-8 w-auto"
                                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                        />
                                    </Link>
                                </div>

                                <div class="hidden h-full lg:flex">
                                    <!-- Mega menus -->
                                    <div class="ml-8">
                                        <div
                                            class="flex h-full justify-center space-x-8"
                                        >
                                            <div
                                                v-for="category in categories.slice(
                                                    0,
                                                    5,
                                                )"
                                                :key="category.name"
                                                class="flex"
                                            >
                                                <div class="relative flex">
                                                    <Link
                                                        :href="
                                                            route(
                                                                'categories.show',
                                                                {
                                                                    category:
                                                                        category.name,
                                                                },
                                                            )
                                                        "
                                                        class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                    >
                                                        {{
                                                            capitalize(
                                                                category.name,
                                                            )
                                                        }}
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile menu and search (lg-) -->
                                <div class="flex flex-1 items-center lg:hidden">
                                    <button
                                        class="-ml-2 rounded-md bg-white p-2 text-gray-400"
                                        type="button"
                                        @click="mobileMenuOpen = true"
                                    >
                                        <span class="sr-only">Open menu</span>
                                        <Bars3Icon
                                            aria-hidden="true"
                                            class="h-6 w-6"
                                        />
                                    </button>
                                </div>

                                <!-- Logo (lg-) -->
                                <Link :href="route('index')" class="lg:hidden">
                                    <span class="sr-only"
                                        >Tech World Express</span
                                    >
                                    <img
                                        alt=""
                                        class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                    />
                                </Link>

                                <div
                                    class="flex flex-1 items-center justify-end"
                                >
                                    <div class="flex items-center lg:ml-8">
                                        <div class="flex space-x-8">
                                            <div class="flex">
                                                <Link
                                                    :href="
                                                        !user
                                                            ? route('login')
                                                            : route('dashboard')
                                                    "
                                                    class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                                                >
                                                    <span class="sr-only"
                                                        >Account</span
                                                    >
                                                    <UserIcon
                                                        aria-hidden="true"
                                                        class="h-6 w-6"
                                                    />
                                                </Link>
                                            </div>
                                        </div>

                                        <span
                                            aria-hidden="true"
                                            class="mx-4 h-6 w-px bg-gray-200 lg:mx-6"
                                        />

                                        <div class="flow-root">
                                            <Link
                                                class="group -m-2 flex items-center p-2"
                                                href="#"
                                            >
                                                <ShoppingCartIcon
                                                    aria-hidden="true"
                                                    class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                />
                                                <span
                                                    class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800"
                                                    >0</span
                                                >
                                                <span class="sr-only"
                                                    >items in cart, view
                                                    bag</span
                                                >
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="bg-gray-50">
            <slot></slot>
        </main>

        <FooterComponent />
    </div>
</template>

<style scoped></style>
