<script lang="ts" setup>
defineProps<{
    name: string;
    image: string;
}>();
</script>

<template>
    <div class="lg:col-span-4 lg:row-end-1">
        <div
            class="aspect-h-3 aspect-w-4 overflow-hidden rounded-lg bg-gray-100"
        >
            <img :alt="name" :src="image" class="object-cover object-center" />
        </div>
    </div>
</template>

<style scoped></style>
