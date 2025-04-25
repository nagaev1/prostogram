<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-secondary dark:text-dark-secondary dark:hover:text-dark-hover transition duration-150 ease-in-out hover:bg-bg-secondary hover:dark:bg-bg-dark-secondary focus:bg-bg-secondary focus:dark:bg-bg-dark-secondary focus:outline-none"
    >
        <slot />
    </Link>
</template>
