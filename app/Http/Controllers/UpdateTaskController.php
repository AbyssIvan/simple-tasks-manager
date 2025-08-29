<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\TaskUpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Put(
    path: "/api/tasks/{id}",
    summary: 'Update task',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(type: TaskRequest::class)
    ),
    tags: ['#Task'],
    parameters: [new OA\Parameter(name: 'id', description: 'Entity id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), examples: ['' => new OA\Examples(example: 'id', summary: 'id', value: 19)])],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task successfully updated',
            content: new OA\JsonContent(example: ['message' => 'Task successfully updated'])
        ),
    ]
)]
class UpdateTaskController extends Controller
{
    public function __invoke(TaskRequest $request, int $id) : JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->update([
            'title'       => $request->validated('title') ?? $task->title,
            'description' => $request->validated('description'),
            'status'      => $request->validated('status') ?? $task->status,
        ]);

        TaskUpdatedEvent::dispatch($task);
        
        return new JsonResponse(
            [
                'message' => 'Task successfully updated'
            ],
            200
        );
    }
}
