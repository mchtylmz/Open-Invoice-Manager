<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class ActivityService
{
    public static function log(string $action, ?Model $subject = null, ?string $description = null): void
    {
        Activity::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id' => $subject?->getKey(),
            'subject_name' => $subject?->getAttribute('name') ?? $subject?->getAttribute('invoice_number') ?? $subject?->getAttribute('quote_number') ?? null,
            'description' => $description,
        ]);
    }
}
