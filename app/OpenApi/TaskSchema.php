<?php

namespace App\OpenApi;

/**
 * @OA\Schema(
 *     schema="Task",
 *     title="Task",
 *     description="Task model",
 *     required={"title", "status"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Task ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Task title",
 *         maxLength=255,
 *         example="Buy groceries"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Task status",
 *         enum={"pending", "completed"},
 *         example="pending"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation date"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update date"
 *     )
 * )
 */
class TaskSchema {}