<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    /**
     * Get the resume that owns the project
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
