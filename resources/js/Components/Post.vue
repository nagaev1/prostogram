<script setup>
import LikeCheckbox from './LikeCheckbox.vue';
import { Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    post: Object,
});

const formComment = useForm({
    text: ''
});

const commentsArr = ref(props.post.comments.slice(0,10))
let commentIndex = ref(0)



function likePost(e) {
    if (e.target.checked) {
        axios.post(route('like.store', props.post.id)).then(() => {
            console.log('liked')
        }, () => {
            console.log('error liked');
        });
    } else {
        axios.delete(route('like.destroy', props.post.id)).then(() => {
            console.log('like removed');
        }, () => {
            console.log('error removing like');
        })
    }
}

function comment(e) {
    formComment.post(route('comment.store', props.post.id), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            updateComments()
        }
    })
}

function nextComments() {
    console.log('next comments', commentIndex, props.post.comments.length);
    console.log(commentIndex.value, commentIndex.value + 10);
    
    if (commentIndex.value + 10 >= props.post.comments.length)
        return
    commentIndex.value += 10
    commentsArr.value = props.post.comments.slice(commentIndex.value, commentIndex.value + 10)
}

function prevComments() {
    console.log('next comments', commentIndex, props.post.comments.length);
    if (commentIndex.value <= 0) 
        return
    commentIndex.value -= 10
    commentsArr.value = props.post.comments.slice(commentIndex.value, commentIndex.value + 10)
}

function updateComments() {
    commentsArr.value = props.post.comments.slice(commentIndex.value, commentIndex.value + 10)
}

const isLiked = ref(false)
</script>

<template>
    <div class="bg-bg-primary dark:bg-bg-dark-primary rounded-lg shadow p-4">
        <div class="flex items-center mb-4">
            <img :src="post.user.profile?.avatar ? `/storage/${post.user.profile.avatar}` : '/default-avatar.png'"
                class="w-10 h-10 rounded-full mr-3">
            <Link :href="`/users/${post.user.id}`" class="font-bold text-primary dark:text-dark-primary">{{
                post.user.name }}</Link>
        </div>
        <img :src="`/storage/${post.image}`" class="w-full rounded-lg mb-4">
        <p class="text-primary dark:text-dark-primary">{{ post.caption }}</p>
        <div class="my-2">
            <form action="" method="post">
                <LikeCheckbox :post="post" :click="likePost"
                    :checked="post.likes.find(el => el.user_id == $page.props.auth.user.id)" />
            </form>
        </div>
        <div class="my-2">
            <form @submit.prevent="comment" class="flex gap-4 items-center">
                <textarea id="" :rows="1" v-model="formComment.text"
                    class=" w-full flex-grow bg-bg-secondary dark:bg-bg-dark-secondary text-primary dark:text-dark-primary rounded-lg"
                    placeholder="Comment here"></textarea>
                <button
                    class="size-12 text-primary dark:text-dark-primary rounded-full p-3 bg-bg-secondary dark:bg-bg-dark-secondary">
                    <svg class="fill-primary dark:fill-dark-primary" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376l0 103.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="my-2">
            <ul class="grid gap-4">
                <li v-for="comment in commentsArr" class="">
                    <div class="flex gap-2 items-center">
                        <img :src="comment.user.profile?.avatar ? `/storage/${comment.user.profile.avatar}` : '/storage/default-avatar.png'" alt="" class="size-10 rounded-full mr-3">
                        <span class=" text-md text-primary dark:text-dark-primary">{{ comment.user.name }}</span>
                    </div>
                    <div class=" text-lg text-primary dark:text-dark-primary">{{ comment.text }}</div>
                    <div class=" mt-1 text-xs text-secondary dark:text-secondary">{{  new Date(comment.created_at).toUTCString() }}</div>
                </li>
            </ul>
        </div>
        <div class="flex gap-1 items-center" v-if="props.post.comments.length > 10">
            <button @click="prevComments" class="text-white size-10 bg-bg-secondary dark:bg-bg-dark-secondary rounded-full p-3 inline-flex items-center justify-center">
                <svg class=" fill-primary dark:fill-dark-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
            </button>
            <span class=" text-primary dark:text-dark-primary">
                {{ commentIndex }} - {{ commentIndex + 10 >= props.post.comments.length ? props.post.comments.length : commentIndex + 10 }}
            </span>
            <button @click="nextComments" class="text-white size-10 bg-bg-secondary dark:bg-bg-dark-secondary rounded-full p-3 inline-flex items-center justify-center">
                <svg class=" fill-primary dark:fill-dark-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
            </button>
        </div>
        <p class="text-secondary dark:text-dark-secondary text-sm mt-2">{{ new Date(post.created_at).toUTCString() }}</p>
    </div>
</template>
