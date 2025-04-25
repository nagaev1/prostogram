<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    caption: '',
    image: null,
});

const submit = () => {
    form.post(route('posts.store'), {
        forceFormData: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4">
            <h1 class="text-2xl font-bold mb-6 dark:text-dark-primary">Create New Post</h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <input class="dark:text-dark-primary" type="file" @input="form.image = $event.target.files[0]" />
                    <div v-if="form.errors.image" class="text-red-500 text-sm">{{ form.errors.image }}</div>
                </div>

                <div class="mb-4">
                    <textarea
                        v-model="form.caption"
                        class="w-full rounded border-gray-300"
                        placeholder="Write a caption..."
                    ></textarea>
                    <div v-if="form.errors.caption" class="text-red-500 text-sm">{{ form.errors.caption }}</div>
                </div>

                <button
                    type="submit"
                    class="bg-blue-500 text-bg-primary dark:text-bg-dark-primary px-4 py-2 rounded"
                    :disabled="form.processing"
                >
                    Post
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
