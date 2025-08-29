<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Events\TaskCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/tasks",
    summary: 'Create task',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(type: TaskRequest::class)
    ),
    tags: ['#Task'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task successfully created',
            content: new OA\JsonContent(example: ['message' => 'Task successfully created'])
        ),
    ]
)]
class CreateTaskController extends Controller
{
    public function __invoke(TaskRequest $request) : JsonResponse
    {
        $task = Task::create(array_merge($request->safe()->except('status'), ['status' => $request->validated('status') ?? Status::NEW->value]));
        TaskCreatedEvent::dispatch($task);
        
        return new JsonResponse(
            [
                'message' => 'Task successfully created'
            ],
            200
        );
    }
}
