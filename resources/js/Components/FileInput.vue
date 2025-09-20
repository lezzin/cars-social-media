<script setup lang="ts">
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps<{
    modelValue: File | null;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: File | null): void;
}>();

const input = ref<HTMLInputElement | null>(null);
const previewUrl = ref<string | null>(null);

const setFile = (file: File | null) => {
    emit('update:modelValue', file);
    previewUrl.value = file ? URL.createObjectURL(file) : null;
};

const handleChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0] ?? null;
    setFile(file);
};

watch(
    () => props.modelValue,
    (file) => {
        previewUrl.value = file ? URL.createObjectURL(file) : null;
    }
);

const removeFile = () => {
    setFile(null);
    if (input.value) input.value.value = '';
};

const isDragOver = ref(false);

const handleDrop = (event: DragEvent) => {
    event.preventDefault();
    isDragOver.value = false;

    if (event.dataTransfer?.files?.length) {
        setFile(event.dataTransfer.files[0]);
    }
};
</script>

<template>
    <div class="border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-all duration-200
             hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-gray-800
             dark:border-gray-600"
        :class="{ 'border-indigo-500 bg-indigo-50 dark:bg-gray-800 ring-2 ring-indigo-400': isDragOver }"
        @click="input?.click()" @dragover.prevent="isDragOver = true" @dragleave.prevent="isDragOver = false"
        @drop="handleDrop">
        <input type="file" ref="input" class="hidden" @change="handleChange" accept="image/*" />

        <div v-if="!previewUrl" class="text-gray-500 dark:text-gray-400">
            <p class="font-medium">Clique ou arraste uma imagem aqui</p>
            <p class="text-xs">Formatos aceitos: JPG, PNG, WEBP</p>
        </div>

        <div v-else class="relative group w-full">
            <img :src="previewUrl" alt="Preview" class="mx-auto max-h-64 rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700
                 group-hover:brightness-110 transition-transform duration-200" />

            <button type="button" @click.stop="removeFile" class="absolute top-1 right-1 bg-black/60 text-white rounded-full px-1.5 shadow-sm
                   hover:bg-red-600 hover:scale-110 transition-all duration-150">
                ✕
            </button>
        </div>
    </div>
</template>
