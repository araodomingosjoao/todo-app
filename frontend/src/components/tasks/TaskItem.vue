<template>
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <input
                type="checkbox"
                :checked="task.status === 'completed'"
                @change="$emit('toggle-status', task.id)"
                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
            />
            <span
                :class="{
                    'line-through text-gray-500': task.status === 'completed',
                }"
            >
                {{ task.title }}
            </span>
        </div>
        <div class="flex items-center space-x-2">
            <button
                @click="$emit('edit', task)"
                class="text-gray-600 hover:text-blue-600"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                </svg>
            </button>
            <button
                @click="$emit('delete', task.id)"
                class="text-gray-600 hover:text-red-600"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
defineProps({
    task: {
        type: Object,
        required: true,
    },
});

defineEmits(["toggle-status", "edit", "delete"]);
</script>
