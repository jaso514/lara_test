<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory;

    /**
     * Get the portfolio sites associated with the Resume
     */
    public function portfolioSite(): HasOne
    {
        return $this->hasOne(PortfolioSites::class);
    }

    /**
     * Get the projects associated with the Resume
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
