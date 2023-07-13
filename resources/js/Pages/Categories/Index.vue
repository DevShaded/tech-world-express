<script lang="ts" setup>
import { Category } from "@/types/ProductType";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import CategoryList from "@/Components/CategoryList.vue";
import CategoryHeader from "@/Components/CategoryHeader.vue";

defineProps<{
    data: {
        categories: {
            data: Category[];
        };
    };
}>();
</script>

<template>
    <DefaultLayout>
        <div class="py-5 rounded">
            <div class="max-w-7xl mx-auto py-5 rounded">
                <div class="mx-5">
                    <CategoryHeader>
                        <template #title> Shop by Category</template>
                    </CategoryHeader>

                    <CategoryList
                        v-if="data.categories.data.length"
                        :categories="data.categories.data"
                    />
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
