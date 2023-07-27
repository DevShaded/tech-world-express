<script lang="ts" setup>
import { StarIcon } from "@heroicons/vue/20/solid";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import { FaqsEntity, ReviewsEntity, Specification } from "@/types/ProductType";
import ProductRatingForm from "@/Components/Product/ProductRatingForm.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

defineProps<{
    productId: number;
    categoryName: string;
    reviews: ReviewsEntity[] | null | undefined;
    faqs: FaqsEntity[] | null | undefined;
    specification: Specification[] | null | undefined;
}>();

const user = computed(() => usePage().props.auth.user);

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp);
    return date.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
};
</script>

<template>
    <TabGroup as="div">
        <div class="border-b border-gray-200">
            <TabList class="-mb-px flex space-x-8">
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            selected
                                ? 'border-indigo-600 text-indigo-600'
                                : 'border-transparent text-gray-700 hover:border-gray-300 hover:text-gray-800',
                            'whitespace-nowrap border-b-2 py-6 text-sm font-medium',
                        ]"
                    >
                        Customer Reviews
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            selected
                                ? 'border-indigo-600 text-indigo-600'
                                : 'border-transparent text-gray-700 hover:border-gray-300 hover:text-gray-800',
                            'whitespace-nowrap border-b-2 py-6 text-sm font-medium',
                        ]"
                    >
                        FAQ
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            selected
                                ? 'border-indigo-600 text-indigo-600'
                                : 'border-transparent text-gray-700 hover:border-gray-300 hover:text-gray-800',
                            'whitespace-nowrap border-b-2 py-6 text-sm font-medium',
                        ]"
                    >
                        Specifications
                    </button>
                </Tab>
            </TabList>
        </div>
        <TabPanels as="template">
            <TabPanel class="-mb-10">
                <h3 class="sr-only">Customer Reviews</h3>

                <ProductRatingForm
                    v-if="user"
                    :category-name="categoryName"
                    :product-id="productId"
                />

                <div
                    v-for="(review, reviewIdx) in reviews"
                    :key="review.id"
                    class="flex space-x-4 text-sm text-gray-500"
                >
                    <div
                        :class="[
                            reviewIdx === 0 ? '' : 'border-t border-gray-200',
                            'py-10 w-full',
                        ]"
                    >
                        <h3 class="font-medium text-gray-900">
                            {{ review.user.name }}
                        </h3>
                        <p>
                            <time :datetime="review.created_at"
                                >{{ timestampToDate(review.created_at) }}
                            </time>
                        </p>

                        <div class="mt-4 flex items-center">
                            <StarIcon
                                v-for="rating in [0, 1, 2, 3, 4]"
                                :key="rating"
                                :class="[
                                    review.rating > rating
                                        ? 'text-yellow-400'
                                        : 'text-gray-300',
                                    'h-5 w-5 flex-shrink-0',
                                ]"
                                aria-hidden="true"
                            />
                        </div>
                        <p class="sr-only">
                            {{ review.rating }} out of 5 stars
                        </p>

                        <div
                            class="prose prose-sm mt-4 max-w-none text-gray-500"
                            v-html="review.content"
                        />
                    </div>
                </div>
            </TabPanel>

            <TabPanel class="text-sm text-gray-500">
                <h3 class="sr-only">Frequently Asked Questions</h3>

                <dl>
                    <template v-for="faq in faqs" :key="faq.question">
                        <dt class="mt-10 font-medium text-gray-900">
                            {{ faq.question }}
                        </dt>
                        <dd
                            class="prose prose-sm mt-2 max-w-none text-gray-500"
                        >
                            <p>{{ faq.answer }}</p>
                        </dd>
                    </template>
                </dl>
            </TabPanel>

            <TabPanel class="pt-10">
                <h3 class="sr-only">Specifications</h3>

                <table class="table-auto w-full">
                    <tbody>
                        <template v-for="spec in specification" :key="spec.id">
                            <tr>
                                <td class="px-4 py-2 border">
                                    {{ spec.name }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ spec.value }}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </TabPanel>
        </TabPanels>
    </TabGroup>
</template>

<style scoped></style>
