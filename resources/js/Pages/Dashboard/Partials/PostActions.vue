<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { Post } from '@/types';

const props = defineProps<{ post: Post }>();
const emit = defineEmits<{
    (e: 'like', postId: number): void;
    (e: 'openComments', postId: number): void;
}>();

const like = () => emit('like', props.post.id);
const openComments = () => emit('openComments', props.post.id);
</script>

<template>
    <div class="flex items-center gap-3">
        <button @click="like"
            :class="`group relative inline-flex items-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-200 ease-in-out transform ${props.post.liked_by_user ? 'bg-gradient-to-r from-pink-500 to-red-500 text-white' : 'bg-gray-700 text-white hover:bg-gray-500'}`">
            <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ props.post.likes_count }}</span>
            <span class="hidden sm:inline">{{ props.post.liked_by_user ? 'Curtido' : 'Curtir' }}</span>
        </button>

        <button @click="openComments"
            class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-full font-medium text-sm bg-gray-700 text-white hover:bg-gray-500 transition-all duration-200 ease-in-out transform">
            <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span>{{ props.post.comments_count }}</span>
            <span class="hidden sm:inline">Comentar</span>
        </button>
    </div>
</template>
