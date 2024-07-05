<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerUser extends Model
{
    use HasFactory;

    /**
     * Get the portfolio sites associated with the customer user.
     */
    public function portfolioSites(): HasMany
    {
        return $this->hasMany(PortfolioSites::class);
    }
}
