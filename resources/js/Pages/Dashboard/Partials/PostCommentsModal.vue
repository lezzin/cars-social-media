<script setup lang="ts">
import { defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import CommentItem from './CommentItem.vue';
import { Comment } from '@/types';

const props = defineProps<{
    show: boolean;
    comments: Comment[];
    isLoading: boolean;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'reply', payload: { parentId: number; content: string }): void;
}>();

const close = () => emit('close');
const reply = (payload: { parentId: number; content: string }) => emit('reply', payload);
</script>

<template>
    <Modal :show="props.show" @close="close">
        <div class="flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-gray-100">Comentários</h3>
                <button @click="close" class="p-2 hover:bg-gray-800 rounded-full transition-colors duration-200">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                <div v-if="props.isLoading" class="flex justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>

                <div v-else-if="props.comments.length === 0" class="text-center py-12 text-gray-300">
                    Nenhum comentário ainda
                </div>

                <CommentItem v-for="comment in props.comments" :key="comment.id" :comment="comment"
                    :isLoading="props.isLoading" @reply="reply" />
            </div>
        </div>
    </Modal>
</template>
