<?php

namespace App\Domains\Catalog\Product\Services;

use Illuminate\Support\Str;
use App\Domains\Catalog\Product\Models\Product;
use App\Support\TenantContext;

class ProductService
{
    public function create(array $data): Product
    {
        $tenant = TenantContext::getTenant();

        $data['tenant_id'] = $tenant->id;
        $data['slug'] = Str::slug($data['name']);

        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $product->update($data);

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}