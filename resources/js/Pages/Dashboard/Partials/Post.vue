<script setup lang="ts">
import { usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Post, PostReaction, Comment } from '@/types';
import PostActions from './PostActions.vue';
import CommentInput from './CommentInput.vue';
import PostCommentsModal from './PostCommentsModal.vue';
import axios from 'axios';

const props = defineProps<{ post: Post }>();
const emit = defineEmits<{
    (e: 'liked', data: { likes_count: number; liked_by_user: boolean }, postId: number): void;
    (e: 'commented', postId: number): void;
    (e: 'deleted', postId: number): void;
}>();

const newComment = ref('');
const comments = ref<Comment[]>([]);
const showingPostComments = ref(false);
const isLoading = ref(false);

function react(type: PostReaction, parentId: number | null = null, content?: string) {
    if (type === 'LIKE') {
        axios.post(`/post/${props.post.id}/like`)
            .then(res => emit('liked', res.data, props.post.id))
            .catch(err => console.error(err));

        return;
    }

    const commentContent = parentId ? content : newComment.value;
    if (!commentContent?.trim()) return;

    isLoading.value = true;

    router.post(`/post/${props.post.id}/comment`, { content: commentContent, parent_id: parentId }, {
        preserveScroll: true,
        onSuccess: () => {
            emit('commented', props.post.id);
            newComment.value = '';
            fetchComments();
        },
        onFinish: () => isLoading.value = false
    });
}

const closeModal = () => showingPostComments.value = false;
const seePostComments = async () => {
    showingPostComments.value = true;
    await fetchComments();
}

const fetchComments = async () => {
    isLoading.value = true;

    try {
        const { data } = await axios.get(`/post/${props.post.id}/comments`);
        comments.value = data.comments;
    } catch (err) {
        console.error('Erro ao carregar comentários:', err);
    } finally {
        isLoading.value = false;
    }
};

const replyToComment = (payload: { parentId: number; content: string }) => {
    react('COMMENT', payload.parentId, payload.content);
}

const isOwner = usePage().props.auth.user?.id === props.post.user.id;

function deletePost() {
    if (!confirm('Deseja realmente excluir esta postagem?')) return;

    router.delete(`/post/${props.post.id}`, {
        preserveScroll: true,
        onSuccess: () => emit('deleted', props.post.id)
    });
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

                        <p class="text-gray-400 text-xs">• {{ props.post.created_at }}</p>
                    </div>

                    <p class="text-gray-300 text-sm">
                        @{{ props.post.user.username }}
                    </p>
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

        <div v-if="props.post.image" class="rounded-lg overflow-hidden border border-gray-600 mb-3">
            <img :src="props.post.image" alt="" class="w-full object-cover" />
        </div>

        <div class="space-y-4">
            <PostActions :post="props.post" @like="() => react('LIKE')" @openComments="seePostComments" />

            <CommentInput :text="newComment" :user="props.post.user" :isLoading="isLoading"
                @update:text="newComment = $event" @submit="() => react('COMMENT')" />

            <PostCommentsModal :show="showingPostComments" :comments="comments" :isLoading="isLoading"
                @close="closeModal" @reply="replyToComment" />
        </div>
    </div>
</template>
