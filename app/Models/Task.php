<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Task
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Task extends Model
{
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
