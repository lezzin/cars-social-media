<script setup lang="ts">
import { defineProps, defineEmits, computed, ref, watch } from 'vue';
import { User } from '@/types';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps<{
    text: string;
    user: User;
    isLoading: boolean;
}>();

const emit = defineEmits<{
    (e: 'update:text', value: string): void;
    (e: 'submit'): void;
}>();

const disableButton = computed(() => !localText.value.trim() || props.isLoading);
const localText = ref(props.text);

watch(() => props.text, (val) => localText.value = val);
watch(localText, (val) => emit('update:text', val));
</script>

<template>
    <div class="bg-gray-800 rounded-md p-4">
        <div class="flex gap-3">
            <img :src="props.user.image" alt="" class="w-12 h-12 rounded-full object-cover border border-gray-600" />

            <div class="flex-1 flex gap-2 items-center">
                <TextInput v-model="localText" type="text" placeholder="Escreva um comentário..."
                    class="flex-1 !rounded-full" @keypress.enter="$emit('submit')" />

                <PrimaryButton @click="$emit('submit')" :disabled="disableButton"
                    class="disabled:opacity-50 disabled:cursor-not-allowed !rounded-full py-2">
                    {{ props.isLoading ? '...' : 'Comentar' }}
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
