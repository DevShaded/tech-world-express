<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { PencilSquareIcon } from "@heroicons/vue/20/solid";
</script>

<template>
    <Link
        :href="route('billing.edit')"
        class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-300">
        <PencilSquareIcon class="h-5 w-5 text-gray-200" aria-hidden="true"/>
        Edit Credit Card Info
    </Link>
</template>

<style scoped>

</style>
