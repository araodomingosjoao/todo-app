<template>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
            <button
                @click="handleCreateTask"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Add New Task
            </button>
        </div>

        <TaskList 
            @edit="handleEditTask"
            @create="handleCreateTask"
        />

        <TaskModal 
            v-if="showModal"
            :task="selectedTask"
            @close="handleCloseModal"
            @submit="handleSubmitTask"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useTasksStore } from '@/stores/tasks';
import TaskList from "@/components/tasks/TaskList.vue";
import TaskModal from "@/components/tasks/TaskModal.vue";

const store = useTasksStore();
const showModal = ref(false);
const selectedTask = ref(null);

const handleCreateTask = () => {
    selectedTask.value = null;
    showModal.value = true;
};

const handleEditTask = (task) => {
    selectedTask.value = task;
    showModal.value = true;
};

const handleCloseModal = () => {
    showModal.value = false;
    selectedTask.value = null;
};

const handleSubmitTask = async (taskData) => {
    try {
        if (selectedTask.value) {
            await store.updateTask(selectedTask.value.id, taskData);
        } else {
            await store.createTask(taskData);
        }
        handleCloseModal();
    } catch (error) {
        console.error('Error submitting task:', error);
    }
};

</script>