<template>
    <div class="bg-white rounded-lg shadow">
        <div v-if="loading" class="p-4 text-center text-gray-500">
            Loading...
        </div>

        <div v-else-if="error" class="p-4 text-center text-red-500">
            {{ error }}
        </div>

        <div
            v-else-if="tasks.length === 0"
            class="p-4 text-center text-gray-500"
        >
            No tasks found
        </div>

        <div v-else>
            <TaskItem
                v-for="task in tasks"
                :key="task.id"
                :task="task"
                @toggle-status="handleToggleStatus"
                @edit="$emit('edit', task)"
                @delete="handleDelete"
            />
        </div>

        <!-- Pagination -->
        <div v-if="tasks.length > 0" class="p-4 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-700">
                    Showing {{ pagination.currentPage }} of
                    {{ pagination.lastPage }} pages
                </span>
                <div class="flex space-x-2">
                    <button
                        :disabled="pagination.currentPage === 1"
                        @click="changePage(pagination.currentPage - 1)"
                        class="px-3 py-1 rounded border border-gray-300 disabled:opacity-50"
                    >
                        Previous
                    </button>
                    <button
                        :disabled="
                            pagination.currentPage === pagination.lastPage
                        "
                        @click="changePage(pagination.currentPage + 1)"
                        class="px-3 py-1 rounded border border-gray-300 disabled:opacity-50"
                    >
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, defineEmits } from "vue";
import { storeToRefs } from "pinia";
import { useTasksStore } from "@/stores/tasks";
import TaskItem from "./TaskItem.vue";

const store = useTasksStore();
const { tasks, loading, error, pagination } = storeToRefs(store);

defineEmits(["toggle-status", "edit"]);

onMounted(() => {
    store.fetchTasks();
});

const handleToggleStatus = async (taskId) => {
    try {
        await store.toggleTaskStatus(taskId);
    } catch (error) {
        console.error("Error toggling task status:", error);
    }
};

const handleDelete = async (taskId) => {
    if (confirm("Are you sure you want to delete this task?")) {
        try {
            await store.deleteTask(taskId);
        } catch (error) {
            console.error("Error deleting task:", error);
        }
    }
};

const changePage = (page) => {
    store.fetchTasks(page);
};
</script>
