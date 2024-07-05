<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PortfolioSites extends Model
{
    use HasFactory;

    /**
     * Get the portfolio sites associated with the customer user.
     */
    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }

    /**
     * Get the customer user that owns the portfolio site.
     */
    public function customerUser(): BelongsTo
    {
        return $this->belongsTo(CustomerUser::class);
    }
}
