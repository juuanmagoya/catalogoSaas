<?php

namespace App\Domains\Tenant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Catalog\Category\Models\Category;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subdomain',
        'email',
        'plan_id',
        'trial_ends_at',
        'subscription_ends_at',
        'status',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

    public function plan()
    {
        //return $this->belongsTo(\App\Domains\Plan\Models\Plan::class);
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}