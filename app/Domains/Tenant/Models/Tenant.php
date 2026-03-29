<?php

namespace App\Domains\Tenant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Catalog\Category\Models\Category;
use App\Models\User; 
use App\Domains\Plan\Models\Plan;
use App\Domains\Catalog\Product\Models\Product;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'plan_id',
        'trial_ends_at',
        'subscription_ends_at',
        'status',
        'instagram',
        'facebook',
        'description',
        'address',
        'logo_path',
        'whatsapp_number'
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function hasFeature(string $feature): bool
    {
        $features = [
            'Plan Básico' => [
                'catalog',
            ],

            'Premium Pro' => [
                'catalog',
                'cart',
                'whatsapp_order',
            ],
        ];

        $planName = $this->plan->name ?? null;

        return in_array($feature, $features[$planName] ?? []);
    }
}