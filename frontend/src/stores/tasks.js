import { defineStore } from 'pinia'
import { TasksService } from '@/services/api/tasks'

export const useTasksStore = defineStore('tasks', {
    state: () => ({
        tasks: [],
        loading: false,
        error: null,
        pagination: {
            currentPage: 1,
            lastPage: 1,
            perPage: 15,
            total: 0
        }
    }),

    actions: {
        updatePagination(meta) {
            this.pagination = {
                currentPage: meta.current_page,
                lastPage: meta.last_page,
                perPage: meta.per_page,
                total: meta.total
            }
        },

        async fetchTasks(page = 1) {
            this.loading = true
            try {
                const response = await TasksService.getAll({ page })
                this.tasks = response.data.data
                this.updatePagination(response.data.meta)
            } catch (error) {
                this.error = error.response?.data?.message || 'Error fetching tasks'
                throw error
            } finally {
                this.loading = false
            }
        },

        async createTask(taskData) {
            try {
                const response = await TasksService.create(taskData)
                this.tasks.unshift(response.data.data)
                return response.data
            } catch (error) {
                this.error = error.response?.data?.message || 'Error creating task'
                throw error
            }
        },

        async updateTask(taskId, taskData) {
            try {
                const response = await TasksService.update(taskId, taskData)
                const index = this.tasks.findIndex(task => task.id === taskId)
                if (index !== -1) {
                    this.tasks[index] = response.data.data
                }
                return response.data
            } catch (error) {
                this.error = error.response?.data?.message || 'Error updating task'
                throw error
            }
        },

        async deleteTask(taskId) {
            try {
                await TasksService.delete(taskId)
                const index = this.tasks.findIndex(task => task.id === taskId)
                if (index !== -1) {
                    this.tasks.splice(index, 1)
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Error deleting task'
                throw error
            }
        },

        async toggleTaskStatus(taskId) {
            try {
                const response = await TasksService.toggleStatus(taskId)
                const index = this.tasks.findIndex(task => task.id === taskId)
                if (index !== -1) {
                    this.tasks[index] = response.data.data
                }
                return response.data
            } catch (error) {
                this.error = error.response?.data?.message || 'Error toggling task status'
                throw error
            }
        }
    }
})