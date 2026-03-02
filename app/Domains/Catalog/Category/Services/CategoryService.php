<?php

namespace App\Domains\Catalog\Category\Services;

use Illuminate\Support\Str;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;

class CategoryService
{
    public function create(array $data): Category
    {
        $tenant = TenantContext::getTenant();

        $data['tenant_id'] = $tenant->id;
        $data['slug'] = Str::slug($data['name']);

        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}