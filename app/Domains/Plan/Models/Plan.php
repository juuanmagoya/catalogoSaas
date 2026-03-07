<?php

namespace App\Domains\Plan\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Tenant\Models\Tenant;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'max_products',
    ];

    /**
     * Relación con tenants
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}