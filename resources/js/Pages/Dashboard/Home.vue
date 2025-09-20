<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { provide, ref, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { DashboardPageProps, Post as PostType } from '@/types';
import Post from './Partials/Post.vue';
import FileInput from '@/Components/FileInput.vue';

const { props } = usePage<DashboardPageProps>();
const posts = ref<PostType[]>(props.posts);

const addingNewPost = ref(false);
const descriptionInput = ref<HTMLInputElement | null>(null);

const closeModal = () => {
    form.reset();
    addingNewPost.value = false
};

const addNewPost = () => (addingNewPost.value = true);

const form = useForm<{ description: string; image: File | null }>({
    description: '',
    image: null,
});

const addPost = () => {
    form.post(route('post.create'), {
        preserveScroll: true,
        onSuccess: (page) => {
            const newPosts = page.props.posts as PostType[] | undefined;

            if (newPosts?.length) {
                posts.value.unshift(newPosts[0]);
            }

            closeModal();
            form.reset();
        },
        onError: () => descriptionInput.value?.focus(),
    });
};

const handleCommentedPost = (postId: number) => {
    const post = posts.value.find(p => p.id === postId);

    if (post) {
        post.comments_count++;
    }
};

function handleDeletedPost(postId: number) {
    posts.value = posts.value.filter(p => p.id !== postId);
}

function handleReactedPost(data: { likes_count: number; liked_by_user: boolean }, postId: number) {
    const post = posts.value.find(p => p.id === postId);

    if (post) {
        post.likes_count = data.likes_count;
        post.liked_by_user = data.liked_by_user;
    }
}

provide('postActions', {
    handleDeletedPost,
    handleReactedPost,
});

watch(
    () => props.posts,
    (newPosts) => {
        posts.value = newPosts;
    }
);
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="pt-12 pb-24 flex flex-col items-center gap-6">
            <template v-if="posts.length > 0">
                <Post v-for="post in posts" :key="post.id" :post="post" @deleted="handleDeletedPost"
                    @liked=handleReactedPost @commented="handleCommentedPost" />
            </template>
            <div v-else class="text-gray-500 text-center">
                Nenhum post disponível.
            </div>
        </div>

        <div class="fixed bottom-10 right-10">
            <PrimaryButton @click="addNewPost">New Post</PrimaryButton>
        </div>

        <Modal :show="addingNewPost" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Add new post to the dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Share an insane car that you have seen in your day-to-day!
                </p>

                <div class="grid gap-2 mt-6">
                    <div class="grid">
                        <InputLabel for="description" value="Description" class="sr-only" />
                        <TextInput id="description" ref="descriptionInput" v-model="form.description" type="text"
                            placeholder="Place any description..." />
                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="grid">
                        <InputLabel for="image" value="Image" class="sr-only" />
                        <FileInput v-model="form.image" />
                        <InputError :message="form.errors.image" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

                    <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="addPost">
                        Add new post
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
