<?php

namespace App\Http\Controllers;

class StorageController extends Controller
{
    public function show($path)
{
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
}
}
