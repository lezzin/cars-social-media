<script setup lang="ts">
import { ref, defineProps } from 'vue';
import { Comment } from '@/types';

const props = defineProps<{
    comment: Comment;
    isLoading: boolean;
}>();

const emit = defineEmits<{
    (e: 'reply', payload: { parentId: number; content: string }): void;
}>();

const replyText = ref('');

const submitReply = () => {
    if (!replyText.value.trim()) return;

    emit('reply', { parentId: props.comment.id, content: replyText.value });
    replyText.value = '';
};
</script>

<template>
    <div class="bg-gray-800 rounded-2xl p-5 space-y-4 border border-gray-700">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <img :src="comment.user.image" :alt="comment.user.name"
                    class="w-10 h-10 rounded-full object-cover border-2 border-gray-900 shadow-sm" />
            </div>

            <div class="flex-1 min-w-0">
                <div class="bg-gray-700 rounded-2xl px-4 py-3 shadow-sm">
                    <p class="font-semibold text-gray-100 text-sm">{{ comment.user.name }}</p>
                    <p class="text-gray-300 mt-1">{{ comment.content }}</p>
                </div>

                <p class="text-xs text-gray-500 mt-2 px-2">
                    {{ comment.created_at }}
                </p>
            </div>
        </div>

        <div class="flex gap-3 pl-13">
            <input v-model="replyText" type="text" placeholder="Responder..."
                class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-full text-sm text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                @keypress.enter="submitReply" />

            <button @click="submitReply" :disabled="!replyText.trim()"
                class="px-3 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 active:scale-95">
                Responder
            </button>
        </div>

        <div v-if="comment.replies?.length" class="space-y-3 pl-13">
            <hr class="border border-gray-700 mb-6">

            <div v-for="reply in comment.replies" :key="reply.id" class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <img :src="reply.user.image" :alt="reply.user.name"
                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-900 shadow-sm" />
                </div>

                <div class="flex-1 min-w-0">
                    <div class="bg-gray-700 rounded-2xl px-4 py-3 shadow-sm border-l-4 border-blue-500">
                        <p class="font-semibold text-gray-100 text-sm">{{ reply.user.name }}</p>
                        <p class="text-gray-300 mt-1 text-sm">{{ reply.content }}</p>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 px-2">
                        {{ reply.created_at }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
