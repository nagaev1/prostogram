<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import SwitchTheme from '@/Components/SwitchTheme.vue';
import { useDark, useToggle } from "@vueuse/core";
const props = defineProps({
    user: Object,
});

const isDark = useDark({
    disableTransition: false
});
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    bio: props.user.profile?.bio || '',
    avatar: null,
    theme: isDark
});

const submit = () => {
    form.post(route('profile.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};


</script>

<template>

    <Head title="Edit Profile" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4">
            <h1 class="text-2xl font-bold mb-6 text-primary dark:text-dark-primary">Edit Profile</h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <input type="text" v-model="form.name"
                        class="w-full rounded border-gray-300 dark:border-dark-secondary bg-bg-primary dark:bg-bg-dark-primary text-primary dark:text-dark-primary" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
                </div>

                <div class="mb-4">
                    <textarea v-model="form.bio"
                        class="w-full rounded border-gray-300 dark:border-dark-secondary bg-bg-primary dark:bg-bg-dark-primary text-primary dark:text-dark-primary"
                        placeholder="Bio"></textarea>
                    <div v-if="form.errors.bio" class="text-red-500 text-sm">{{ form.errors.bio }}</div>
                </div>

                <div class="mb-4">
                    <input type="file" @input="form.avatar = $event.target.files[0]"
                        class="border-gray-300 dark:border-dark-secondary text-primary dark:text-dark-primary" />
                    <div v-if="form.errors.avatar" class="text-red-500 text-sm">{{ form.errors.avatar }}</div>
                </div>
                <div class="mb-4">
                    <SwitchTheme v-model="form.theme" />
                </div>

                <button type="submit" class="bg-blue-500 text-bg-primary dark:text-bg-dark-primary px-4 py-2 rounded"
                    :disabled="form.processing">
                    Save Changes
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
