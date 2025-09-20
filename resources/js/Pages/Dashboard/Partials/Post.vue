<script setup lang="ts">
import { Post } from '@/types';
import { usePage, router } from '@inertiajs/vue3';

const emit = defineEmits(['deleted']);

const props = defineProps<{ post: Post }>();
const page = usePage();

const isOwner = page.props.auth.user?.id === props.post.user.id;

function deletePost() {
    if (!confirm('Deseja realmente excluir esta postagem?')) return;

    router.delete(`/posts/${props.post.id}`, {
        onSuccess: () => emit('deleted', props.post.id)
    });
}

function react(type: string) {
    console.log(`Reação: ${type}`);
}
</script>

<template>
    <div class="max-w-xl w-full p-4 border border-gray-700 rounded-lg">
        <div class="flex items-start justify-between mb-3">
            <div class="flex items-center space-x-3">
                <a href="" target="_blank" rel="noopener noreferrer" class="flex-shrink-0">
                    <img :src="props.post.user.image" alt=""
                        class="w-12 h-12 rounded-full object-cover border border-gray-600" />
                </a>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center space-x-1">
                        <a href="" target="_blank" rel="noopener noreferrer"
                            class="font-bold text-white hover:underline truncate">
                            {{ props.post.user.name }}
                        </a>

                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z" />
                        </svg>
                    </div>

                    <a href="" target="_blank" rel="noopener noreferrer" class="text-gray-400 text-sm hover:underline">
                        @{{ props.post.user.username }}
                    </a>
                </div>
            </div>

            <button v-if="isOwner" @click="deletePost" class="text-red-500 hover:text-red-400 text-sm font-semibold">
                Remover
            </button>
        </div>

        <div class="mb-3">
            <p class="text-gray-200 text-sm leading-relaxed whitespace-pre-wrap">
                {{ props.post.description }}
            </p>
        </div>

        <div v-if="props.post.image_url" class="rounded-lg overflow-hidden border border-gray-600 mb-3">
            <img :src="props.post.image_url" alt="" class="w-full object-cover" />
        </div>

        <div class="flex justify-between items-center text-gray-400 text-xs mt-2">
            <div>1:15 PM · Dec 20, 2024</div>

            <div class="flex space-x-4">
                <button @click="react('like')" class="hover:text-blue-500">👍 Curtir</button>
                <button @click="react('comment')" class="hover:text-green-500">💬 Comentar</button>
                <button @click="react('share')" class="hover:text-purple-500">🔗 Compartilhar</button>
            </div>
        </div>
    </div>
</template>
