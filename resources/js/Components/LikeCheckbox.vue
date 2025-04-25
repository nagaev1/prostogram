<style scoped>
.on:checked~.like .like-icon {
    fill: #fc4e4e;
    animation: enlarge 0.2s ease-out 1;
    transition: all 0.2s ease-out;
}

.on:checked~.like-count.two {
    transform: translateX(0);
}

.on:checked~.like-count.one {
    transform: translateY(-40px);
}

@keyframes enlarge {
    0% {
        transform: scale(0.5);
    }

    100% {
        transform: scale(1.2);
    }
}
</style>

<script setup>

defineProps({
    post: Object,
    click: Function,
    checked: Boolean,
});

</script>

<template>
    <div
        class=" relative cursor-pointer flex h-12 w-36 rounded-2xl border-none bg-bg-secondary dark:bg-bg-dark-secondary overflow-hidden">
        <input class="on hidden" :id="'heart' + post.id" type="checkbox" v-on:change="click" :checked="checked" />
        <label class="like w-[70%] h-full flex cursor-pointer items-center justify-evenly" :for="'heart' + post.id">
            <svg class="like-icon fill-primary dark:fill-dark-primary size-7" fill-rule="nonzero" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z">
                </path>
            </svg>
            <span class="like-text text-primary dark:text-dark-primary text-lg ">Likes</span>
        </label>
        <span
            class="like-count one absolute right-0 w-1/3 h-full flex justify-center items-center text-secondary dark:text-dark-secondary text-lg border-l-2 border-secondary dark:border-dark-secondary transition-all">{{
                post.likes.length - (checked ? 1 : 0) }}</span>
        <span
            class="like-count two translate-y-10 absolute right-0 w-1/3 h-full flex justify-center items-center text-secondary dark:text-dark-secondary text-lg border-l-2 border-secondary dark:border-dark-secondary transition-all">{{
                post.likes.length + (checked ? 0 : 1) }}</span>
    </div>
</template>
