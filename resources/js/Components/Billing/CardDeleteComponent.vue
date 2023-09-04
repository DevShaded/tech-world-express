<script setup lang="ts">
import { TrashIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";

defineProps<{
    id: number
}>();
</script>

<template>
    <Link
        :href="route('billing.destroy', id)"
        method="delete"
        as="button"
        type="button"
        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-300">
        <TrashIcon class="h-5 w-5 text-red-500" aria-hidden="true"/>
        Delete this card
    </Link>
</template>

<style scoped>

</style>
