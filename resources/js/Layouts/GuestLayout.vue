<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-bg-secondary dark:bg-bg-dark-secondary pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-secondary dark:text-dark-secondary" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-bg-primary dark:bg-bg-dark-primary px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
