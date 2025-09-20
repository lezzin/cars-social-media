<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
</script>

<template>
    <section>
        <div class="flex items-center space-x-3">
            <img :src="user.image" alt="" class="w-20 h-20 rounded-full object-cover border border-gray-600" />

            <div class="min-w-0 flex-1">
                <p class="font-bold text-white truncate text-lg">
                    {{ user.name }}
                </p>

                <p class="text-gray-400 text-sm">
                    @{{ user.username }}
                </p>
            </div>
        </div>
    </section>
</template>
