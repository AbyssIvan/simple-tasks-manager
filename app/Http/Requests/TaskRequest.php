<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enum\Status;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(property: 'title', description: 'Task title', type: 'string', example: 'Test title'),
        new OA\Property(property: 'description', description: 'Task description', type: 'string', example: 'Some description'),
        new OA\Property(property: 'status', description: 'Task status', type: 'string', example: Status::NEW->value),
    ],
    example: [
        "name"        => 'Test title',
        "description" => 'Some description',
        "status"      => Status::NEW->value,
    ]
)]
class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @psalm-return array<string, ValidationRule|array|string>
     */
    public function rules() : array
    {
        return [
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'status'      => ['nullable', new Enum(Status::class)],
        ];
    }
}
