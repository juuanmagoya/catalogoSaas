<?php

namespace App\Domains\Plan\Services;

use App\Domains\Plan\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanService
{
    /**
     * Crear plan
     */
    public function create(array $data): Plan
    {
        return DB::transaction(function () use ($data) {

            return Plan::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'duration_days' => $data['duration_days'],
                'max_products' => $data['max_products'] ?? null,
            ]);

        });
    }

    /**
     * Actualizar plan
     */
    public function update(Plan $plan, array $data): Plan
    {
        return DB::transaction(function () use ($plan, $data) {

            $plan->update([
                'name' => $data['name'],
                'price' => $data['price'],
                'duration_days' => $data['duration_days'],
                'max_products' => $data['max_products'] ?? null,
            ]);

            return $plan;

        });
    }

    /**
     * Eliminar plan
     */
    public function delete(Plan $plan): void
    {
        DB::transaction(function () use ($plan) {

            $plan->delete();

        });
    }
}