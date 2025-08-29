<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

#[OA\Get(
    path: '/api/tasks',
    summary: 'Get tasks list',
    tags: ['#Task'],
    parameters: [
        new OA\Parameter(name: 'filter[status]', description: 'Task status', in: 'query', required: false, schema: new OA\Schema(type: 'string'), example: Status::NEW->value),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Success response',
            content: new OA\JsonContent(type: 'array', items: new OA\Items(properties: [
                new OA\Property(property: 'id', type: 'integer', example: 2),
                new OA\Property(property: 'title', type: 'string', example: 'Test title'),
                new OA\Property(property: 'description', type: 'string', example: 'Some discription'),
                new OA\Property(property: 'status', type: 'string', example: Status::NEW->value),
            ]))
        ),
    ]
)]
class TaskListController extends Controller
{
    public function __invoke(Request $request) : array
    {
        $builder = QueryBuilder::for(Task::class)
            ->select([
                'tasks.*',
            ])
            ->allowedFilters([
                AllowedFilter::exact('status', 'tasks.status'),
            ])
            ->defaultSort('-tasks.id');

        $data = [];
        /** @var Task $task */
        foreach ($builder->get() as $task) {
            $data[] = [
                'id'          => $task->id,
                'title'       => $task->title,
                'description' => $task->description,
                'status'      => $task->status->label(),
            ];
        }

        return $data;
    }
}
