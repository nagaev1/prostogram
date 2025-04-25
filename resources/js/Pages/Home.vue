<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Post from '@/Components/Post.vue';

defineProps({
    posts: Object,
});
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4">
            <div class="mb-6">
                <Link href="/posts/create" class="bg-blue-500 text-bg-primary dark:text-bg-dark-primary px-4 py-2 rounded-lg">
                    New Post
                </Link>
            </div>

            <div v-for="post in posts.data" :key="post.id" class="mb-6">
                <Post :post="post" />
            </div>

            <Pagination :links="posts.links" class="mt-6" />
        </div>
    </AuthenticatedLayout>
</template>
