<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Responses\ApiResponse;
use App\Models\Task;
use App\Services\TaskService;

/**
* @OA\Info(
*     title="Tasks API",
*     version="1.0.0",
*     description="API for task management"
* )
*/
class TaskController extends Controller
{
   public function __construct(
       protected TaskService $taskService
   ) {}

   /**
    * List all tasks
    * 
    * @OA\Get(
    *     path="/api/tasks",
    *     tags={"Tasks"},
    *     summary="Get all tasks",
    *     description="Returns a paginated list of tasks",
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(ref="#/components/schemas/Task")
    *             )
    *         )
    *     )
    * )
    */
   public function index()
   {
       $tasks = $this->taskService->getAllTasks();
       return TaskResource::collection($tasks);
   }

   /**
    * Create a new task
    * 
    * @OA\Post(
    *     path="/api/tasks",
    *     tags={"Tasks"},
    *     summary="Create a new task",
    *     description="Create a new task and return it",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/Task")
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Task created",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Task created successfully"),
    *             @OA\Property(property="data", ref="#/components/schemas/Task")
    *         )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation error"
    *     )
    * )
    */
   public function store(TaskRequest $request)
   {
       $task = $this->taskService->createTask($request->validated());

       return ApiResponse::success(
           'Task created successfully', 
           new TaskResource($task)
       );
   }

   /**
    * Get a specific task
    * 
    * @OA\Get(
    *     path="/api/tasks/{id}",
    *     tags={"Tasks"},
    *     summary="Get task by ID",
    *     description="Returns a single task",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of task to return",
    *         required=true,
    *         @OA\Schema(type="integer", format="int64")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(ref="#/components/schemas/Task")
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Task not found"
    *     )
    * )
    */
   public function show(Task $task)
   {
       return new TaskResource($task);
   }

   /**
    * Update a specific task
    * 
    * @OA\Put(
    *     path="/api/tasks/{id}",
    *     tags={"Tasks"},
    *     summary="Update a task",
    *     description="Update a task's details",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of task to update",
    *         required=true,
    *         @OA\Schema(type="integer", format="int64")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/Task")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Task updated",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Task updated successfully"),
    *             @OA\Property(property="data", ref="#/components/schemas/Task")
    *         )
    *     )
    * )
    */
   public function update(TaskRequest $request, Task $task)
   {
       $task = $this->taskService->updateTask($task, $request->validated());
       
       return ApiResponse::success(
           'Task updated successfully',
           new TaskResource($task)
       );
   }

   /**
    * Delete a task
    * 
    * @OA\Delete(
    *     path="/api/tasks/{id}",
    *     tags={"Tasks"},
    *     summary="Delete a task",
    *     description="Delete a specific task",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of task to delete",
    *         required=true,
    *         @OA\Schema(type="integer", format="int64")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Task deleted",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Task deleted successfully")
    *         )
    *     )
    * )
    */
   public function destroy(Task $task)
   {
       $this->taskService->deleteTask($task);
       
       return ApiResponse::success('Task deleted successfully');
   }

   /**
    * Toggle task status
    * 
    * @OA\Patch(
    *     path="/api/tasks/{id}/toggle-status",
    *     tags={"Tasks"},
    *     summary="Toggle task status",
    *     description="Toggle between pending and completed status",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of task to toggle status",
    *         required=true,
    *         @OA\Schema(type="integer", format="int64")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Status toggled",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Task status updated successfully"),
    *             @OA\Property(property="data", ref="#/components/schemas/Task")
    *         )
    *     )
    * )
    */
   public function toggleStatus(Task $task)
   {
       $task = $this->taskService->toggleStatus($task);
       
       return ApiResponse::success(
           'Task status updated successfully',
           new TaskResource($task)
       );
   }
}