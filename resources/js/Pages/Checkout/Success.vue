<script lang="ts" setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

defineProps<{
    data: {
        order: object;
    };
}>();
</script>

<template>
    <DefaultLayout>
        <pre>{{ data.order }}</pre>
    </DefaultLayout>
</template>

<style scoped></style>
