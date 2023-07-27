<script lang="ts" setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Editor from "@tinymce/tinymce-vue";

const props = defineProps<{
    productId: number;
    categoryName: string;
}>();

const userId = computed(() => usePage().props.auth.user.id);

const form = useForm({
    product_id: props.productId,
    user_id: userId,
    category_name: props.categoryName,
    content: null,
    rating: 1,
});

const submit = () => {
    form.post("/product/review", {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <div class="mt-5">
        <form class="relative" @submit.prevent="submit">
            <div
                class="overflow-hidden rounded-lg border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500"
            >
                <label class="sr-only" for="description">Description</label>
                <Editor
                    id="description"
                    v-model="form.content"
                    :init="{
                        toolbar: false,
                        menubar: false,
                        statusbar: false,
                    }"
                    class="block w-full resize-none border-0 py-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    name="description"
                    placeholder="Write the content of your review here."
                    rows="2"
                />
                <div v-if="form.errors.content">
                    <p class="text-sm pl-3 text-red-500 font-bold">
                        {{ form.errors.content }}
                    </p>
                </div>

                <!-- Spacer element to match the height of the toolbar -->
                <div aria-hidden="true">
                    <div class="py-2">
                        <div class="h-9" />
                    </div>
                    <div class="h-px" />
                    <div class="py-2">
                        <div class="py-px">
                            <div class="h-9" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute inset-x-px bottom-0">
                <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->
                <div
                    class="flex flex-nowrap justify-end space-x-2 px-2 py-2 sm:px-3"
                ></div>
                <div
                    class="flex items-center justify-between space-x-3 border-t border-gray-200 px-2 py-2 sm:px-3"
                >
                    <div class="flex">
                        <div>
                            <label
                                class="block text-sm font-medium leading-6 text-gray-900"
                                for="location"
                                >Rating</label
                            >
                            <select
                                id="location"
                                v-model="form.rating"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                name="location"
                            >
                                <option value="1">1 Star</option>
                                <option value="2">2 Star</option>
                                <option value="3">3 Star</option>
                                <option value="4">4 Star</option>
                                <option value="5">5 Star</option>
                            </select>
                        </div>
                    </div>

                    <div v-if="form.errors.rating">
                        <p class="text-sm pl-3 text-red-500 font-bold">
                            {{ form.errors.rating }}
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <button
                            :disabled="form.processing"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped></style>
