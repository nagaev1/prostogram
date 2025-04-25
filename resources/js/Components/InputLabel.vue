<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block text-sm font-medium text-hover dark:text-dark-hover">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
