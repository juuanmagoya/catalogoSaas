@extends('layouts.app')

@php
$tenant = request()->route('tenant');
@endphp

@section('content')

<h1 class="text-3xl font-semibold mb-8 tracking-wide text-neutral-800"
    style="font-family: 'Playfair Display', serif;">
    Panel del Negocio
</h1>

<p class="mb-10 text-neutral-600">
    Bienvenido, <span class="font-semibold text-neutral-900">{{ $data['userName'] }}</span>
    <span class="text-neutral-400">|</span>
    <span class="text-neutral-500">{{ $data['tenantName'] }}</span>
</p>

{{-- ================= METRIC CARDS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

    {{-- Tarjeta Productos --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Total Productos</p>
        <p class="text-4xl font-bold mt-2 text-amber-700">{{ $data['productsCount'] }}</p>
    </div>

    {{-- Tarjeta Categorías --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Total Categorías</p>
        <p class="text-4xl font-bold mt-2 text-amber-700">{{ $data['categoriesCount'] }}</p>
    </div>

</div>

{{-- ================= MANAGEMENT LINKS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <a href="{{ route('tenant.admin.categories.index', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block text-center">

        <p class="text-lg font-semibold text-neutral-700">📂 Categorías</p>
        <p class="text-sm text-neutral-500 mt-1">Gestionar categorías</p>

    </a>

    <a href="{{ route('tenant.admin.products.index', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block text-center">

        <p class="text-lg font-semibold text-neutral-700">📦 Productos</p>
        <p class="text-sm text-neutral-500 mt-1">Gestionar productos</p>

    </a>

    <a href="{{ route('tenant.admin.settings.edit', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block text-center">

        <p class="text-lg font-semibold text-neutral-700">⚙️ Configuración</p>
        <p class="text-sm text-neutral-500 mt-1">Ajustes del negocio</p>

    </a>

</div>

@endsection