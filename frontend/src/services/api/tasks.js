import api from "@/config/axios";

export const TasksService = {
    getAll(params = {}) {
        return api.get("/tasks", { params });
    },

    get(id) {
        return api.get(`/tasks/${id}`);
    },

    create(data) {
        return api.post("/tasks", data);
    },

    update(id, data) {
        return api.put(`/tasks/${id}`, data);
    },

    delete(id) {
        return api.delete(`/tasks/${id}`);
    },

    toggleStatus(id) {
        return api.patch(`/tasks/${id}/toggle-status`);
    },
};
