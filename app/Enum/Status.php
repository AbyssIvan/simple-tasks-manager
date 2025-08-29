<?php

namespace App\Enum;

enum Status : string
{
    case NEW           = 'new';
    case IN_PROGRESS   = 'in_progress';
    case READY_TO_TEST = 'ready_to_test';
    case COMPLETED     = 'completed';
    case CLOSED        = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::NEW           => 'New',
            self::IN_PROGRESS   => 'In progress',
            self::READY_TO_TEST => 'Ready to test',
            self::COMPLETED     => 'Completed',
            self::CLOSED        => 'Closed',
        };
    }
}
