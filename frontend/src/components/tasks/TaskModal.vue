<template>
    <div
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
    >
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ task ? "Edit Task" : "Create New Task" }}
                </h2>
                <button
                    @click="$emit('close')"
                    class="text-gray-500 hover:text-gray-700"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Title
                    </label>
                    <input
                        id="title"
                        v-model="formData.title"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': errors.title }"
                    />
                    <p v-if="errors.title" class="mt-1 text-sm text-red-600">
                        {{ errors.title }}
                    </p>
                </div>

                <div class="mb-6">
                    <label
                        for="status"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Status
                    </label>
                    <select
                        id="status"
                        v-model="formData.status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': errors.status }"
                    >
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <p v-if="errors.status" class="mt-1 text-sm text-red-600">
                        {{ errors.status }}
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        type="button"
                        @click="$emit('close')"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        :disabled="isSubmitting"
                    >
                        {{ isSubmitting ? "Saving..." : "Save" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";

const props = defineProps({
    task: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(["close", "submit"]);

const formData = reactive({
    title: "",
    status: "pending",
});

const errors = reactive({
    title: "",
    status: "",
});

const isSubmitting = ref(false);

onMounted(() => {
    if (props.task) {
        formData.title = props.task.title;
        formData.status = props.task.status;
    }
});

const validateForm = () => {
    let isValid = true;
    errors.title = "";
    errors.status = "";

    if (!formData.title.trim()) {
        errors.title = "Title is required";
        isValid = false;
    }

    if (!formData.status) {
        errors.status = "Status is required";
        isValid = false;
    }

    return isValid;
};

const handleSubmit = async () => {
    if (!validateForm()) return;

    try {
        isSubmitting.value = true;
        await emit("submit", { ...formData });
    } catch (error) {
        console.error("Error submitting form:", error);
    } finally {
        isSubmitting.value = false;
    }
};
</script>
