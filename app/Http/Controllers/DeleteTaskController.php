<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/task/{id}",
    summary: 'Delete task',
    tags: ['#Task'],
    parameters: [new OA\Parameter(name: 'id', description: 'Entity id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), examples: ['' => new OA\Examples(example: 'id', summary: 'id', value: 19)])],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Task successfully deleted',
            content: new OA\JsonContent(example: ['message' => 'Task successfully deleted'])
        ),
    ]
)]
class DeleteTaskController extends Controller
{
    public function __invoke(int $id) : JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();
        
        return new JsonResponse(
            [
                'message' => 'Task successfully deleted'
            ],
            200
        );
    }
}
